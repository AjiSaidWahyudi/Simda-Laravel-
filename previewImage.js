let selectedFiles = []; // Menampung file baru (File Object)
let existingFiles = []; // Menampung file lama (String URL/Path)

const input = document.getElementById('image-input');
const dropzone = document.querySelector('.image-dropzone');
const addBtn = dropzone.querySelector('.add-image');
const form = input.closest('form'); // Ambil form terdekat

// Fungsi sinkronisasi ke input file (khusus untuk file baru)
function updateInputFiles() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    input.files = dataTransfer.files;
}

// Handler Klik Tombol "+"
addBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    input.click();
});

// Handler Pilih File Baru
input.addEventListener('change', e => {
    const files = Array.from(e.target.files);
    handleFiles(files);
});

function handleFiles(files) {
    for (const file of files) {
        // Cek total gabungan baru + lama
        if ((selectedFiles.length + existingFiles.length) >= 4) {
            alert('Maksimal 4 gambar');
            break;
        }

        selectedFiles.push(file);
        renderPreview(file, true);
    }
    updateInputFiles();
}

// Fungsi Render Preview (Gabungan Baru & Lama)
function renderPreview(fileData, isNew = true) {
    const wrapper = document.createElement('div');
    wrapper.classList.add('image-wrapper');
    wrapper.style.position = 'relative';

    // Jika file baru, buat blob URL. Jika lama, gunakan URL string (path)
    const src = isNew ? URL.createObjectURL(fileData) : fileData;
    
    // Ambil nama file saja untuk gambar lama (untuk dikirim ke controller)
    const fileName = isNew ? "" : fileData.split('/').pop();

    wrapper.innerHTML = `
        <img src="${src}" class="preview-img" style="width:80px;height:80px;object-fit:cover;border-radius:4px;">
        <button type="button" class="remove-btn" style="
            position:absolute;top:-5px;right:-5px;
            background:red;color:white;border:none;
            border-radius:50%;width:20px;height:20px;
            cursor:pointer;">×</button>
        ${!isNew ? `<input type="hidden" name="existing_images[]" value="${fileName}">` : ''}
    `;

    wrapper.querySelector('.remove-btn').onclick = function(ev) {
        ev.stopPropagation();
        if (isNew) {
            selectedFiles = selectedFiles.filter(f => f !== fileData);
            updateInputFiles(); // Update input file setelah dihapus
        } else {
            existingFiles = existingFiles.filter(f => f !== fileData);
            // Hidden input akan otomatis hilang karena wrapper.remove()
        }
        wrapper.remove();
    };

    dropzone.insertBefore(wrapper, addBtn);
}

// Memuat gambar lama dari database (dipanggil di Blade)
window.initExistingImages = function(imageUrls) {
    imageUrls.forEach(url => {
        existingFiles.push(url);
        renderPreview(url, false);
    });
};

// Pastikan sinkronisasi terakhir saat submit (Pengaman Mobile)
form.addEventListener('submit', () => {
    updateInputFiles();
});