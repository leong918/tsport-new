@if (session('primary'))
    <div class="alert alert-primary" role="alert">{{ session('primary') }}</div>
@endif

@if (session('secondary'))
    <div class="alert alert-secondary" role="alert">{{ session('secondary') }}</div>
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
@endif

@if (session('warning'))
    <div class="alert alert-warning" role="alert">{{ session('warning') }}</div>
@endif

@if (session('info'))
    <div class="alert alert-info" role="alert">{{ session('info') }}</div>
@endif

@if (session('light'))
    <div class="alert alert-light" role="alert">{{ session('light') }}</div>
@endif

@if (session('dark'))
    <div class="alert alert-dark" role="alert">{{ session('dark') }}</div>
@endif

@if (isset($errors) && $errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @if (count($errors->all()) <= 1)
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @else
            <ul style="margin-bottom: 0px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif
