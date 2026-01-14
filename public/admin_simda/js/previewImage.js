let selectedFiles = [];

const dropzone = document.querySelector('.image-dropzone');
const input = document.getElementById('image-input');

// ⛔ cegah default browser
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropzone.addEventListener(eventName, e => e.preventDefault());
});

// ✨ efek visual (opsional)
dropzone.addEventListener('dragover', () => {
    dropzone.classList.add('dragover');
});

dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('dragover');
});

// 📦 HANDLE DROP
dropzone.addEventListener('drop', e => {
    dropzone.classList.remove('dragover');

    const files = Array.from(e.dataTransfer.files).filter(f =>
        f.type.startsWith('image/')
    );

    handleFiles(files);
});

function handleFiles(files) {
    const preview = document.querySelector('.image-dropzone');

    for (const file of files) {
        if (selectedFiles.length >= 4) {
            alert('Maksimal 4 gambar');
            break;
        }

        selectedFiles.push(file);

        const reader = new FileReader();
        reader.onload = function (e) {
            const wrapper = document.createElement('div');
            wrapper.classList.add('image-wrapper');

            wrapper.innerHTML = `
                <img src="${e.target.result}" class="preview-img">
                <button type="button" class="remove-btn">×</button>
            `;

            wrapper.querySelector('.remove-btn').onclick = function (event) {
                event.stopPropagation();
                selectedFiles = selectedFiles.filter(f => f !== file);
                wrapper.remove();
                syncInputFiles();
            };

            preview.insertBefore(wrapper, preview.querySelector('.add-image'));
        };

        reader.readAsDataURL(file);
    }

    syncInputFiles();
}

input.addEventListener('change', function (e) {
    handleFiles(Array.from(e.target.files));
    e.target.value = '';
});

document.getElementById('image-input').addEventListener('change', function (e) {
    const files = Array.from(e.target.files);
    const preview = document.querySelector('.image-dropzone');

    for (const file of files) {
        if (selectedFiles.length >= 4) {
            alert('Maksimal 4 gambar');
            break;
        }

        selectedFiles.push(file);

        const reader = new FileReader();
        reader.onload = function (e) {
            const wrapper = document.createElement('div');
            wrapper.classList.add('image-wrapper');

            wrapper.innerHTML = `
                <img src="${e.target.result}" class="preview-img">
                <button type="button" class="remove-btn">×</button>
            `;

            wrapper.querySelector('.remove-btn').onclick = function (event) {
                event.stopPropagation(); // 🔥 PENTING
                selectedFiles = selectedFiles.filter(f => f !== file);
                wrapper.remove();
                syncInputFiles();
            };

            preview.insertBefore(wrapper, preview.querySelector('.add-image'));
        };

        reader.readAsDataURL(file);
    }

    syncInputFiles();
    e.target.value = '';
});

function syncInputFiles() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    document.getElementById('image-input').files = dataTransfer.files;
}

// Existing image (edit only)
function removeExistingImage(btn, event) {
    event.stopPropagation(); // 🔥 cegah bubble
    if (!confirm('Hapus gambar ini dari daftar?')) return;
    btn.closest('.image-wrapper').remove();
}
