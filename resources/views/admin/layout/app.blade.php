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
    <script src="{{ asset('assets/admin/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('assets/admin/js/popper.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/js/tempus-dominus.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jQuery-provider.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("form .image-uploader").change(function() {
                readURL(this);
            });

            function readURL(input) {
                if (input && input.files) {
                    var previewContainer = $(input).closest('form').find('#image-preview-container');;
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
