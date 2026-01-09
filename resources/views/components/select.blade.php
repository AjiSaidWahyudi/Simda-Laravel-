@props(['label', 'name', 'options' => [], 'value' => null])

<div class="col-md-4">
    <label class="form-label">{{ $label }}</label>
    <select
        name="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'form-select ' . ($errors->has($name) ? 'is-invalid' : '')
        ]) }}
    >
        <option value="" disabled {{ old($name, $value) ? '' : 'selected' }}>
            Pilih {{ $label }}
        </option>

        @foreach ($options as $key => $text)
            <option
                value="{{ $key }}"
                {{ old($name, $value) == $key ? 'selected' : '' }}
            >
                {{ $text }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>