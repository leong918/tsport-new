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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <script src="https://cdn.jsdelivr.net/npm/mustache@4.2.0/mustache.min.js"></script>
    <script src="{{asset('assets/web/js/cart.js')}}"></script>
    <script type="text/javascript">
    $('.navbar-search').on('click', function(){
        $('#header').toggleClass('active');
        $('#sub-pages-overlay').toggleClass('active');
        $('body').toggleClass('active');
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

    $('.narber-toggler-concept').on('click', function(){
        $('#nav-search-toggle').collapse('hide');
        $('#header').removeClass('active');
        $('#sub-pages-overlay').removeClass('active');
        $('body').removeClass('active');
    })
    
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

    function updateColumnValue(array) {
        $('.subtotal-price').html('$' + array.subtotal.toFixed(2));
        $('.point-price').html('$' + array.point_redemption.toFixed(2));
        $('.order-total-price').html('$' + array.total.toFixed(2));
        $('.shipping-price').html(array.delivery_partner + ' : $' + array.shipping_fee.toFixed(2));

        if (Array.isArray(array.discount) && array.discount.length > 0) {
            $('#discount').removeClass('d-none');
            $('.discount-content-wrapper').html('');
            $.each(array.discount, function (key, value) {
                var template = document.getElementById('discountLayout').innerHTML;
                var rendered = Mustache.render(template, {
                    name: value.name,
                    price: value.discount_amount.toFixed(2),
                });
                $('.discount-content-wrapper').append(rendered);
            });
        } else {
            $('#discount').addClass('d-none');
            $('.discount-content-wrapper').html('');
        }

        if (Array.isArray(array.coupon) && array.coupon.length > 0) {
            $('#coupon').removeClass('d-none');
            $('.coupon-content-wrapper').html('');
            $.each(array.coupon, function (key, value) {
                var template = document.getElementById('couponLayout').innerHTML;
                var rendered = Mustache.render(template, {
                    id: value.id,
                    name: value.name,
                    price: value.discount_amount.toFixed(2),
                });
                $('.coupon-content-wrapper').append(rendered);
            });
        } else {
            $('#coupon').addClass('d-none');
            $('.coupon-content-wrapper').html('');
        }
    }

    </script>
    @stack('scripts')
</body>

</html>
