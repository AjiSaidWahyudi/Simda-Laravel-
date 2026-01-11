@props([
    'name',
    'existing' => [],
])

<div class="col-12">
    <label class="form-label">Foto Barang (maks. 4)</label>

    {{-- Hidden input --}}
    <input
        type="file"
        id="image-input"
        name="{{ $name }}"
        accept="image/*"
        multiple
        hidden
    >

    {{-- Preview Box --}}
    <div
        class="image-dropzone border rounded p-3 d-flex gap-2 flex-wrap"
        onclick="document.getElementById('image-input').click()"
    >
        {{-- Existing images (edit) --}}
        @foreach ($existing as $img)
            <div class="image-wrapper">
                <img
                    src="{{ asset('gambar_barang/'.$img->inv_id.'/'.$img->gambar) }}"
                    class="preview-img"
                >
                <button
                    type="button"
                    class="remove-btn"
                    onclick="removeExistingImage(this, event)"
                >×</button>
            </div>
        @endforeach

        {{-- Add button --}}
        <div class="add-image">
            <span>+</span>
        </div>
    </div>

    @error(str_replace('[]','',$name))
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>
