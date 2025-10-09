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
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}" />
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
