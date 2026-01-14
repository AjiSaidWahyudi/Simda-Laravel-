let currentIndex = 0;

function showImage(index) {
    const images = document.querySelectorAll('.carousel-image');
    if (!images.length) return;

    images.forEach(img => img.classList.remove('active'));

    currentIndex = (index + images.length) % images.length;
    images[currentIndex].classList.add('active');
}

function nextImage() {
    showImage(currentIndex + 1);
}

function prevImage() {
    showImage(currentIndex - 1);
}