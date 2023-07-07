let slideIndex = 0;
    const slides = document.getElementsByClassName("slide");

    function showSlide(n) {
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex = (slideIndex + n + slides.length) % slides.length;
        slides[slideIndex].style.display = "block";
    }

    function changeSlide(n) {
        showSlide(n);
    }

    function autoSlide() {
        showSlide(1);
    }

    setInterval(autoSlide, 3000); // Change slide every 3 seconds