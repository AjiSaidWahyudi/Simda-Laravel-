function previewMultipleImages(event) {
    const container = document.getElementById('preview-container');
    container.innerHTML = '';

    const files = event.target.files;

    if (files.length > 4) {
        alert('Maksimal 4 gambar');
        event.target.value = '';
        return;
    }

    [...files].forEach(file => {
        const reader = new FileReader();

        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-preview rounded border';
            img.style.width = '120px';
            container.appendChild(img);
        };

        reader.readAsDataURL(file);
    });
}