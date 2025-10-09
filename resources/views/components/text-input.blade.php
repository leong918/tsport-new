@props(['name', 'label', 'placeholder' => '', 'value' => '', 'required' => false, 'type' => 'text'])

<div class="input-field-section mb-3 col-12">
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
        {{ $slot }}
    </div>
</div>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
