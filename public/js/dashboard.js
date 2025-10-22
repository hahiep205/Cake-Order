
document.addEventListener('DOMContentLoaded', () => {

    const menuBtn = document.querySelector(".menu-btn");
    const nav = document.querySelector(".nav");

    menuBtn.addEventListener("click", () => {
        nav.classList.toggle("active");
        menuBtn.classList.toggle("active");
    });

    // Js for image slider nav auto-play
    const btns = document.querySelectorAll(".nav-btn");
    const slides = document.querySelectorAll(".image-slide");
    const contents = document.querySelectorAll(".content");
    const homeSection = document.querySelector(".home");

    let currentSlide = 0;
    let autoPlayInterval;
    const totalSlides = btns.length;
    const autoPlayDelay = 5000;

    var sliderNav = function (manual) {
        btns.forEach((btn) => {
            btn.classList.remove("active");
        });

        slides.forEach((slide) => {
            slide.classList.remove("active");
        });

        contents.forEach((content) => {
            content.classList.remove("active");
        });

        btns[manual].classList.add("active");
        slides[manual].classList.add("active");
        contents[manual].classList.add("active");

        currentSlide = manual;
    }

    // Function to start auto-play
    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            sliderNav(currentSlide);
        }, autoPlayDelay);
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

    // Manual navigation with nav buttons
    btns.forEach((btn, i) => {
        btn.addEventListener("click", () => {
            sliderNav(i);
            stopAutoPlay();
            startAutoPlay();
        });
    });

    homeSection.addEventListener("mouseenter", () => {
        stopAutoPlay();
    });

    homeSection.addEventListener("mouseleave", () => {
        startAutoPlay();
    });

    startAutoPlay();

    // Js for header scroll effect
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');

        if (window.scrollY > 50) {
            // Code hiện tại cho header...
            header.style.background = 'rgba(255, 255, 255, 0.1)';
            header.style.backdropFilter = 'blur(10px)';
            header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';

            const brand = header.querySelector('.brand');
            const navLinks = header.querySelectorAll('.nav-items a, .nav-logs a, .nav_name');

            brand.style.color = '#222';
            navLinks.forEach(link => {
                link.style.color = '#222';
            });

            header.classList.add('scrolled');
            document.body.classList.add('scrolled');

        } else {
            // Code hiện tại cho header...
            header.style.background = 'transparent';
            header.style.backdropFilter = 'none';
            header.style.boxShadow = 'none';

            const brand = header.querySelector('.brand');
            const navLinks = header.querySelectorAll('.nav-items a, .nav-logs a, .nav_name');

            brand.style.color = '#fff';
            navLinks.forEach(link => {
                link.style.color = '#fff';
            });

            header.classList.remove('scrolled');
            document.body.classList.remove('scrolled');
        }
    });

    // Js for close mobile menu after click link
    const navLinks = document.querySelectorAll('.nav-items a, .nav-logs a');

    function closeMenu() {
        nav.classList.remove("active");
        menuBtn.classList.remove("active");
    }

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 1040) {
                closeMenu();
            }
        });
    });

});