document.addEventListener("DOMContentLoaded", function () {

    let slideIndex = 0;
    const track = document.querySelector('.carousel-track');
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.dot');

    function showSlide(index) {
        if (index >= slides.length) slideIndex = 0;
        if (index < 0) slideIndex = slides.length - 1;

        track.style.transform = `translateX(${-slideIndex * 100}%)`;

        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === slideIndex);
        });
    }

    function nextSlide() {
        slideIndex++;
        showSlide(slideIndex);
    }

    window.currentSlide = function (n) {
        slideIndex = n - 1;
        showSlide(slideIndex);
    };

    showSlide(slideIndex);

    // AUTOPLAY
    setInterval(nextSlide, 4000);

});
