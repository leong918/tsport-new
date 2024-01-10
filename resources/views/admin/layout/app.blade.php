<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Ecommerce Boilerplate Admin Template">
    <meta name="author" content="VVinners">
    <meta name="keyword" content="Bootstrap,Admin,Template,SCSS,HTML,RWD,Dashboard">
    <title>Ecommerce Boilerplate Admin Template</title>
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.0.0-rc.1/dist/js/coreui.bundle.min.js" integrity="sha384-KW7wTEji2ZsXsIoA4O34wfu6+kd/92iZmHLLSbrfj3D5JlgAJNWobqk0VRB2UvIK" crossorigin="anonymous"></script>
    <script>
      if (document.body.classList.contains('dark-theme')) {
        var element =  document.getElementById('btn-dark-theme');
        if (typeof(element) != 'undefined' && element != null) {
          document.getElementById('btn-dark-theme').checked = true;
        }
      } else {
        var element =  document.getElementById('btn-light-theme');
        if (typeof(element) != 'undefined' && element != null) {
          document.getElementById('btn-light-theme').checked = true;
        }
      }
      function handleThemeChange(src) {
        var event = document.createEvent('Event');
        event.initEvent('themeChange', true, true);
      
        if (src.value === 'light' ) {
          document.body.classList.remove('dark-theme');
        }
        if (src.value === 'dark' ) {
          document.body.classList.add('dark-theme');
        }
        document.body.dispatchEvent(event);
      }
      
    </script>
  </body>
</html>