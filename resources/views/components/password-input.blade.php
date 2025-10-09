@props(['name', 'label', 'placeholder' => '', 'showForgotPassword' => false, 'required' => false])

<div class="input-field-section password mb-3 col-12">
    <div class="label">{{ $label }}</div>
    <div class="input-field-wrapper">
        <input 
            class="input-field" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            type="password"
            placeholder="{{ $placeholder }}"
            value="{{ old($name) }}"
            @if($required) required @endif
        >
        <button type="button" onclick="togglePassword('{{ $name }}')" class="toggle-btn">
            <img src="{{ asset('assets/web/images/components/input/icon-hide.png') }}" class="icon icon-hide">
            <img src="{{ asset('assets/web/images/components/input/icon-show.png') }}" class="icon icon-show" style="display: none;">
        </button>
    </div>
    @if($showForgotPassword)
        <button type="button" onclick="togglePassword('{{ $name }}')" class="forgot-btn">
            忘记密码
        </button>
    @endif
</div>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
