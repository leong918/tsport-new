<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ecommerce-boilerplate</title>
    {{-- css --}}
</head>

<body>
@vite(['resources/scss/web/app.scss', 'resources/js/web/app.js'])
        {{-- section header --}}
        @include('web.layout.header')
        {{-- end header --}}
        {{-- section content --}}
        @yield('content')
        {{-- end content --}}
        {{-- section footer --}}
        @include('web.layout.footer')
        {{-- end footer --}}
    @section('script')
    @show
</body>

</html>
