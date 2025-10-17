<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CMS Admin">
    <meta name="author" content="Tag Concept">
    <meta name="keyword" content="Bootstrap,Admin,Template,SCSS,HTML,RWD,Dashboard">
    <title>Display Boilerplate</title>
    <meta name="theme-color" content="#ffffff">
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/tempus-dominus.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2-bootstrap-5-theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap5.min.css') }}" />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @yield('style')
</head>

<body class="mb-0" id="admin-body">
    @vite(['resources/scss/admin/app.scss', 'resources/js/admin/app.js'])
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
    <script src="{{ asset('assets/admin/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('assets/admin/js/popper.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/js/tempus-dominus.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jQuery-provider.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
    <!-- Setup CSRF token for axios requests -->
    <script>
        // Setup axios with CSRF token
        if (typeof axios !== 'undefined') {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token) {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            }
        }
    </script>
    
    <script>
        $(document).ready(function() {
            $("form .image-uploader").change(function() {
                readURL(this);
            });

            function readURL(input) {
                if (input && input.files) {
                    var previewContainer = $(input).parent().find('.image-preview-container');;
                    // Clear previous previews
                    previewContainer.empty();

                    //Show label
                    previewContainer.append('<div><label>Image Preview</label></div>');
                    // Loop through each file selected
                    Array.from(input.files).forEach(file => {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            // Create a new image element
                            var img = $('<img>').attr('src', e.target.result).addClass('img-fluid')
                                .addClass('object-fit-contain');

                            var colDiv = $('<div>').addClass('col-3 d-flex justify-content-center')
                                .append(img);

                            // Append the new image to the preview container
                            previewContainer.append(colDiv);
                        };

                        reader.readAsDataURL(file);
                    });
                } else {
                    console.log("Input or input.files is not defined.");
                }
            }
        });
    </script>
    @section('script')
    @show
</body>

</html>
