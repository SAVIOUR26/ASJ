<?php
/**
 * Minimal dependency-free SMTP client.
 *
 * The site's "no build step, no dependencies" rule (see README) rules out
 * pulling in PHPMailer via Composer, so this hand-rolls just enough of the
 * SMTP protocol to talk to a real mail server (e.g. Mailcow) over
 * STARTTLS or implicit TLS with AUTH LOGIN. If $site['smtp']['host'] is
 * left empty, send_site_mail() falls straight back to PHP's mail().
 */

class SmtpException extends Exception {}

class SmtpMailer
{
    private string $host;
    private int $port;
    private string $encryption; // 'ssl', 'tls', or ''
    private string $username;
    private string $password;
    private int $timeout;
    /** @var resource|null */
    private $socket;

    public function __construct(string $host, int $port, string $encryption, string $username, string $password, int $timeout = 12)
    {
        $this->host = $host;
        $this->port = $port;
        $this->encryption = $encryption;
        $this->username = $username;
        $this->password = $password;
        $this->timeout = $timeout;
    }

    /**
     * @param string $from     Envelope + header From address
     * @param string $fromName Display name for the From header
     * @param string $to       Recipient address
     * @param string $subject
     * @param string $body     Plain-text body
     * @param string|null $replyTo
     * @param array<int,array{filename:string,mime:string,content:string}> $attachments
     */
    public function send(string $from, string $fromName, string $to, string $subject, string $body, ?string $replyTo = null, array $attachments = []): void
    {
        $transport = $this->encryption === 'ssl' ? 'ssl://' : '';
        $this->socket = @stream_socket_client(
            $transport . $this->host . ':' . $this->port,
            $errno,
            $errstr,
            $this->timeout
        );
        if (!$this->socket) {
            throw new SmtpException("Could not connect to {$this->host}:{$this->port} ({$errstr})");
        }
        stream_set_timeout($this->socket, $this->timeout);

        try {
            $this->expect(220);
            $this->command("EHLO " . ($_SERVER['HTTP_HOST'] ?? 'localhost'), 250);

            if ($this->encryption === 'tls') {
                $this->command("STARTTLS", 220);
                if (!stream_socket_enable_crypto($this->socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                    throw new SmtpException('STARTTLS negotiation failed');
                }
                $this->command("EHLO " . ($_SERVER['HTTP_HOST'] ?? 'localhost'), 250);
            }

            if ($this->username !== '') {
                $this->command("AUTH LOGIN", 334);
                $this->command(base64_encode($this->username), 334);
                $this->command(base64_encode($this->password), 235);
            }

            $this->command("MAIL FROM:<{$from}>", 250);
            $this->command("RCPT TO:<{$to}>", 250);
            $this->command("DATA", 354);

            $headers = [];
            $headers[] = "From: " . $this->encodeHeader($fromName) . " <{$from}>";
            $headers[] = "To: <{$to}>";
            $headers[] = "Subject: " . $this->encodeHeader($subject);
            if ($replyTo !== null && $replyTo !== '') {
                $headers[] = "Reply-To: <{$replyTo}>";
            }
            $headers[] = "MIME-Version: 1.0";
            $headers[] = "Date: " . date('r');

            if (empty($attachments)) {
                $headers[] = "Content-Type: text/plain; charset=UTF-8";
                $message = $body;
            } else {
                $boundary = 'asj-' . bin2hex(random_bytes(12));
                $headers[] = "Content-Type: multipart/mixed; boundary=\"{$boundary}\"";

                $parts = "--{$boundary}\r\nContent-Type: text/plain; charset=UTF-8\r\n\r\n{$body}\r\n";
                foreach ($attachments as $attachment) {
                    $parts .= "--{$boundary}\r\n"
                        . "Content-Type: {$attachment['mime']}; name=\"{$attachment['filename']}\"\r\n"
                        . "Content-Transfer-Encoding: base64\r\n"
                        . "Content-Disposition: attachment; filename=\"{$attachment['filename']}\"\r\n\r\n"
                        . chunk_split(base64_encode($attachment['content']))
                        . "\r\n";
                }
                $parts .= "--{$boundary}--";
                $message = $parts;
            }

            $data = implode("\r\n", $headers) . "\r\n\r\n" . $this->stuff($message) . "\r\n.";
            $this->command($data, 250);

            $this->command("QUIT", 221);
        } finally {
            fclose($this->socket);
        }
    }

    private function command(string $line, int $expectedCode): string
    {
        fwrite($this->socket, $line . "\r\n");
        return $this->expect($expectedCode);
    }

    private function expect(int $expectedCode): string
    {
        $response = '';
        while (($line = fgets($this->socket, 515)) !== false) {
            $response .= $line;
            // Multi-line replies use "250-" until the final "250 ".
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }
        $code = (int) substr($response, 0, 3);
        if ($code !== $expectedCode) {
            throw new SmtpException("SMTP server replied '{$response}' (expected {$expectedCode})");
        }
        return $response;
    }

    /** Dot-stuff lines starting with '.' per RFC 5321. */
    private function stuff(string $body): string
    {
        return preg_replace('/^\./m', '..', $body);
    }

    private function encodeHeader(string $value): string
    {
        if (preg_match('/[^\x20-\x7E]/', $value)) {
            return '=?UTF-8?B?' . base64_encode($value) . '?=';
        }
        return $value;
    }
}

/**
 * Send an email using the configured SMTP relay, falling back to mail()
 * when no SMTP host is set (e.g. local preview, or before the client's
 * Mailcow credentials have been filled in).
 *
 * @param array<int,array{filename:string,mime:string,content:string}> $attachments
 * @return bool True on success.
 */
function send_site_mail(array $site, string $to, string $subject, string $body, ?string $replyTo = null, array $attachments = []): bool
{
    $smtp = $site['smtp'] ?? [];
    $host = $smtp['host'] ?? '';

    if ($host === '') {
        $fromHeader = $site['name'] . ' Website <no-reply@' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '>';
        $headers = "From: {$fromHeader}\r\n";
        if ($replyTo !== null && $replyTo !== '') {
            $headers .= "Reply-To: {$replyTo}\r\n";
        }

        if (empty($attachments)) {
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            return @mail($to, $subject, $body, $headers);
        }

        $boundary = 'asj-' . bin2hex(random_bytes(12));
        $headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";
        $message = "--{$boundary}\r\nContent-Type: text/plain; charset=UTF-8\r\n\r\n{$body}\r\n";
        foreach ($attachments as $attachment) {
            $message .= "--{$boundary}\r\n"
                . "Content-Type: {$attachment['mime']}; name=\"{$attachment['filename']}\"\r\n"
                . "Content-Transfer-Encoding: base64\r\n"
                . "Content-Disposition: attachment; filename=\"{$attachment['filename']}\"\r\n\r\n"
                . chunk_split(base64_encode($attachment['content']))
                . "\r\n";
        }
        $message .= "--{$boundary}--";
        return @mail($to, $subject, $message, $headers);
    }

    try {
        $mailer = new SmtpMailer(
            $host,
            (int) ($smtp['port'] ?? 587),
            $smtp['encryption'] ?? 'tls',
            $smtp['username'] ?? '',
            $smtp['password'] ?? '',
        );
        $fromAddress = $smtp['from'] !== '' ? $smtp['from'] : $site['email'];
        $mailer->send($fromAddress, $site['name'] . ' Website', $to, $subject, $body, $replyTo, $attachments);
        return true;
    } catch (SmtpException $e) {
        error_log('[ASJ mailer] ' . $e->getMessage());
        return false;
    }
}
