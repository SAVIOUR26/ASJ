document.addEventListener('DOMContentLoaded', function () {

    /* Sticky header shadow on scroll */
    var header = document.getElementById('site-header');
    var backToTop = document.getElementById('back-to-top');
    function onScroll() {
        var scrolled = window.scrollY > 12;
        if (header) header.classList.toggle('is-scrolled', scrolled);
        if (backToTop) backToTop.classList.toggle('is-visible', window.scrollY > 500);
    }
    document.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    if (backToTop) {
        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* Mobile nav toggle */
    var toggle = document.getElementById('nav-toggle');
    var nav = document.getElementById('site-nav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
        nav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    /* Scroll reveal */
    var revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && revealEls.length) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        revealEls.forEach(function (el) { io.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('is-visible'); });
    }

    /* FAQ accordion */
    document.querySelectorAll('.faq-item').forEach(function (item) {
        var question = item.querySelector('.faq-question');
        var answer = item.querySelector('.faq-answer');
        if (!question || !answer) return;
        question.addEventListener('click', function () {
            var isOpen = item.classList.contains('is-open');
            document.querySelectorAll('.faq-item.is-open').forEach(function (openItem) {
                if (openItem !== item) {
                    openItem.classList.remove('is-open');
                    openItem.querySelector('.faq-answer').style.maxHeight = null;
                    openItem.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                }
            });
            item.classList.toggle('is-open', !isOpen);
            answer.style.maxHeight = !isOpen ? answer.scrollHeight + 'px' : null;
            question.setAttribute('aria-expanded', !isOpen ? 'true' : 'false');
        });
    });
});
