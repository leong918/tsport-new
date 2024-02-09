<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ecommerce-boilerplate</title>
    {{-- css --}}
    <link type="text/css" rel="stylesheet" href="{{ mix('assets/web/default/app.css') }}" />
</head>

<body>
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
        <script type="text/javascript" src="{{ mix('assets/web/app.js') }}"></script>
    @show
</body>

</html>
