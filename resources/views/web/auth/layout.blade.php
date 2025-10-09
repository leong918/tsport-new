@extends('web.layout.app')

@section('content')
<div id="{{ $pageId }}" class="auth-page">
    <div class="form-main-wrapper">
        <div class="position-relative">
            <img src="{{ $backgroundImage }}"
                class="img img-fluid banner-img">
            <div class="form-wrapper position-absolute row">
                <div class="input-field-title mb-3 col-12 text-center">
                    {{ $title }}
                </div>
                
                {{ $slot }}
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // Set body id for specific styling
        document.body.id = '{{ $pageId }}';
        document.body.classList.add('auth-page');
    });
</script>
@endpush
