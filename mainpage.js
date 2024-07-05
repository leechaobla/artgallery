document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('[data-carousell]');
    const slides = carousel.querySelector('[data-slides]');
    const prevButton = carousel.querySelector('[data-carousell-button="previous"]');
    const nextButton = carousel.querySelector('[data-carousell-button="next"]');
    
    let currentIndex = 0;
    const totalSlides = slides.children.length;

    const updateSlidePosition = () => {
        slides.style.transform = `translateX(-${currentIndex * 100}%)`;
    };

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalSlides - 1;
        updateSlidePosition();
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex < totalSlides - 1) ? currentIndex + 1 : 0;
        updateSlidePosition();
    });

    updateSlidePosition(); 
});
