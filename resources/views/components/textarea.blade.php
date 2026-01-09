@props([
    'label',
    'name',
    'value' => '',
    'placeholder' => '',
    'col' => '6',
])

<div class="col-md-{{ $col }}">
    <label class="form-label">
        {{ $label }}
        @if($attributes->has('required'))
            <span class="text-danger">*</span>
        @endif
    </label>

    <textarea
        name="{{ $name }}"
        rows="4"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')
        ]) }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
