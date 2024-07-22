<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hello Smile</title>
    <!-- favicons Icons -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset("assets/favicon/apple-touch-icon.png") }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset("assets/favicon/favicon-32x32.png") }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("assets/favicon/favicon-16x16.png") }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}"> -->

    <link rel="stylesheet" href="{{ asset('assets/web/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.10/dist/css/tempus-dominus.css"/>
    {{-- css --}}
</head>

<body>
    @vite(['resources/scss/web/app.scss', 'resources/js/web/app.js'])
    @include('web.layout.header')

    <div id="main-page">
        @yield('content')

        @include('web.layout.footer')
    </div>

    {{-- <a href="#">
        <img src="{{asset('assets/web/assets/img/home/chatbox.png')}}" alt="hellosmile" class="img img-fluid" id="fixed-chatbox">
    </a> --}}

    <script src="{{ asset('assets/web/js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/slick.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/mustache@4.2.0/mustache.min.js"></script>
    <script src="{{ asset('assets/web/js/popper.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.10/dist/js/tempus-dominus.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.10/dist/js/jQuery-provider.js"></script>
    <script type="text/javascript">
        function showSwal(title = "", text = ""){ 
            swal.fire({
                title: '<button type="button" id="custom-close-button"></button><p class="swal-register-title">' + title + '</p>',
                html: '<p class="swal-register-content-1">' + text + ' </p> ',
                backdrop: false,
                showConfirmButton: false,
                customClass: {
                    container: 'custom-register-swal'
                },
                didOpen: () => {
                    $('#custom-close-button').click(function() {
                        swal.close();
                    });
                }
            });
        }
    </script>
    @stack('scripts')
</body>

</html>
