<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ecommerce-boilerplate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
    {{-- css --}}
</head>

<body>
@vite(['resources/scss/web/app.scss', 'resources/js/web/app.js'])
        {{-- section header --}}
    @include('web.layout.header')
    <div id="main-page">
        @include('web.search')
        {{-- end header --}}
        {{-- section content --}}
        @yield('content')
        <div id="sub-pages-overlay">
        </div>
        {{-- end content --}}
        {{-- section footer --}}
        @include('web.layout.footer')
    </div>
        {{-- end footer --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
    @if (Session::has('swal'))
        Swal.fire({
            title: '{!! Session::get('swal.title') !!}',
            text: '{!! Session::get('swal.text') !!}',
            icon: '{!! Session::get('swal.type') !!}',
            confirmButtonText: 'OK',
        });
    @endif
    $('.navbar-search').on('click', function(){
        $('#header').toggleClass('active');
        $('#sub-pages-overlay').toggleClass('active');
        $('body').toggleClass('active');
        $('.narber-toggler-concept').attr('type', '');
    })
    $('.cross-to-close').on('click', function(){
        $('#header').removeClass('active');
        $('#sub-pages-overlay').removeClass('active');
        $('body').removeClass('active');
        $('#nav-search-toggle').collapse('toggle');
    })
    $('#sub-pages-overlay').on('click', function(){
        $('#header').removeClass('active');
        $('#sub-pages-overlay').removeClass('active');
        $('body').removeClass('active');
        $('#nav-search-toggle').collapse('toggle');
    })
    </script>
    @stack('scripts')
</body>

</html>
