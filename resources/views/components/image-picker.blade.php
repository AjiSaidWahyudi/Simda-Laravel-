@props([
    'name',
    'existing' => [],
])

<div class="col-md-6">
    <label class="form-label">Foto Barang (maks. 4)</label>

    <input
        type="file"
        name="{{ $name }}"
        accept="image/*"
        multiple
        class="form-control
            {{ $errors->has(str_replace('[]','',$name)) || $errors->has(str_replace('[]','',$name).'.*') ? 'is-invalid' : '' }}"
        onchange="previewMultipleImages(event)"
    >

    @error(str_replace('[]','',$name))
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @error(str_replace('[]','',$name).'.*')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-12">
    <label class="form-label d-block">Preview</label>

    <div class="img-preview-wrapper d-flex gap-2 flex-wrap" id="preview-container">
        {{-- existing images (edit) --}}
        @foreach ($existing as $img)
            <img
                src="{{ asset('gambar_barang/'.$img->inv_id.'/'.$img->gambar) }}"
                class="img-preview rounded border"
                width="120"
            >
        @endforeach
    </div>
</div>
