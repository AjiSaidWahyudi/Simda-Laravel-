let zoomIndex = 0;

function openImageZoom(index) {
    const images = document.querySelectorAll('.carousel-image');
    if (!images.length) return;

    zoomIndex = index;

    const overlay = document.getElementById('image-zoom-overlay');
    const img = document.getElementById('zoomed-image');

    img.src = images[zoomIndex].src;
    overlay.style.display = 'flex';
}

function closeImageZoom(event) {
    if (event) event.stopPropagation();
    document.getElementById('image-zoom-overlay').style.display = 'none';
}

function zoomNext(event) {
    event.stopPropagation();
    const images = document.querySelectorAll('.carousel-image');
    zoomIndex = (zoomIndex + 1) % images.length;
    document.getElementById('zoomed-image').src = images[zoomIndex].src;

    // sinkron dengan carousel utama
    showImage(zoomIndex);
}

function zoomPrev(event) {
    event.stopPropagation();
    const images = document.querySelectorAll('.carousel-image');
    zoomIndex = (zoomIndex - 1 + images.length) % images.length;
    document.getElementById('zoomed-image').src = images[zoomIndex].src;

    // sinkron dengan carousel utama
    showImage(zoomIndex);
}

// ESC support
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        closeImageZoom();
    }
});