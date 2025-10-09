@props(['name', 'label', 'placeholder' => '', 'value' => '', 'required' => false, 'type' => 'text', 'size' => 'normal'])

@php
$sizeClass = $size === 'small' ? 'input-field-section-small' : 'input-field-section';
@endphp

<div class="{{ $sizeClass }} mb-3 col-12">
    <div class="label">{{ $label }}</div>
    <div class="input-field-wrapper">
        <input 
            class="input-field" 
            name="{{ $name }}" 
            type="{{ $type }}" 
            placeholder="{{ $placeholder }}"
            value="{{ old($name, $value) }}"
            @if($required) required @endif
        >
    </div>
</div>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
