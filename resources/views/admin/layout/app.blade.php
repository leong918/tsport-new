<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="Ecommerce Boilerplate Admin Template">
  <meta name="author" content="Tag Concept">
  <meta name="keyword" content="Bootstrap,Admin,Template,SCSS,HTML,RWD,Dashboard">
  <title>Hello Smile</title>
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/admin/css/tempus-dominus.css') }}" />
  @yield('style')
</head>

<body class="mb-0" id="admin-body">
  @vite(['resources/scss/app.scss', 'resources/js/app.js'])
  @include('admin.layout.sidebar')
  <div class="wrapper d-flex flex-column min-vh-100 bg-light dark:bg-transparent">
    @include('admin.layout.header')

    <div class="body flex-grow-1 px-3">
      @yield('content')
    </div>

    @include('admin.layout.footer')
  </div>
  <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/coreui.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/sweetalert2@11.js')}}"></script>
  <script src="{{ asset('assets/admin/js/popper.min.js') }}" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/admin/js/tempus-dominus.js') }}"></script>
  <script src="{{ asset('assets/admin/js/jQuery-provider.js') }}"></script>
  @section('script')
  @show
</body>

</html>