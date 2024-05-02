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
    <link rel="stylesheet" href="{{ asset('assets/admin/css/all.min.css') }}" 
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body class="mb-0">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center dark:bg-transparent">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="card-group d-block d-md-flex row">
              <x-alert />
              <div class="card col-md-7 p-4 mb-0">
                {{ html()->form('POST', route("admin.login.post"))->open() }}
                <div class="card-body">
                  <h1>Login</h1>
                  <p class="text-medium-emphasis">Sign In to your account</p>
                  <div class="input-group mb-3"><span class="input-group-text">
                      <i class="fa-solid fa-user"></i></span>
                    <input class="form-control" name="username" type="text" placeholder="Username">
                  </div>
                  <div class="input-group mb-3"><span class="input-group-text">
                      <i class="fa-solid fa-lock"></i></span>
                    <input class="form-control" name="password" type="password" placeholder="Password">
                  </div>
                  <div class="row mb-2">
                    <div class="col-7">
                      <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-shield"></i></span>
                        <input class="form-control" name="captcha" type="text" placeholder="Captcha">
                      </div>
                    </div>
                    <div class="col-5 d-flex align-items-center justify-content-between">
                      <img src="{{Captcha::src('flat')}}" class="img-fluid captcha-img" />
                      <span id="refresh" style="cursor: pointer;">
                          <i class="fa fa-refresh"></i>
                      </span>
                    </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-6">
                          {{ html()->checkbox('remember') }}
                          {{ html()->label('Remember me') }}
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" type="submit">Login</button>
                    </div>
                  </div>
                </div>
                {{ html()->form()->close() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $('#refresh').on('click', function () {
              var captcha = $('img.captcha-img');
              var config = captcha.data('refresh-config');
              axios.get('{{ route('captcha') }}')
                  .then((response) => {
                      captcha.prop('src', response.data);
                  })
        });
      });
    </script>
  </body>
</html>