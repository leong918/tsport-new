<!DOCTYPE html>
<html lang="sc">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Display Boilerplate">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>T Power Sport</title>
    @vite(['resources/scss/web/app.scss', 'resources/js/web/app.js'])
    @stack('styles')
</head>

<body id="app" class="@yield('body-class', 'bg-1')">
    {{-- Header outside ScrollSmoother to ensure it's always visible --}}
    @include('web.layout.header')

    <div id="smooth-wrapper">
        <div id="smooth-content">
            @yield('content')
            
            @include('web.layout.footer')
        </div>
    </div>
    @stack('modals')
    @stack('scripts')
</body>

</html>
