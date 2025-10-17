@props([
    'name', 
    'label', 
    'placeholder' => '', 
    'value' => '', 
    'required' => false, 
    'type' => 'text', 
    'class' => '',
    'showForgotPassword' => false
])

<div class="input-field-section {{ $type === 'password' ? 'password' : '' }} mb-3 col-12">
    <div class="label">{{ $label }}</div>
    <div class="input-field-wrapper">
        <input 
            class="input-field {{ $class }}" 
            id="{{ $name }}"
            name="{{ $name }}" 
            type="{{ $type }}" 
            placeholder="{{ $placeholder }}"
            value="{{ old($name, $value) }}"
            @if($required) required @endif
        >
        
        @if($type === 'password')
            <button type="button" onclick="togglePassword('{{ $name }}')" class="toggle-btn">
                <img src="{{ asset('assets/web/images/components/input/icon-hide.png') }}" class="icon icon-hide">
                <img src="{{ asset('assets/web/images/components/input/icon-show.png') }}" class="icon icon-show" style="display: none;">
            </button>
        @endif
        
        {{ $slot }}
    </div>
    
    @if($type === 'password' && $showForgotPassword)
        <a href="#" class="forgot-btn">
            忘记密码
        </a>
    @endif
</div>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
