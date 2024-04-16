$(document).ready(function () {
    $('.cart-button-redirect').on('click', function () {
        window.location.href = $(this).data('href');
    })

    $('.cart-button-hover').on('click', function (e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var url = $(this).data('url');
        var attribute = {};

        if ($('.attribute-input').length > 0) {
            $('.attribute-input').each(function (i, obj) {
                if (!$(obj).val()) {
                    showSwal('Warning!', 'Please choose ' + obj.data('name'));
                    return false;
                }
            });

            $.each($('#attributeForm').serializeArray(), function () {
                attribute[this.name] = this.value;
            });
        }

        axios({
            method: "post",
            url: url,
            data: {
                product_id: product_id,
                attribute: attribute
            }
        })
            .then(response => {
                $('#cart-count').removeClass('d-none').text(response.data.cart_count);

                swal.fire({
                    title: '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Success!</p>',
                    html: '<p class="swal-register-content-1">Product added to cart successfully.</p> ',
                    backdrop: false,
                    showConfirmButton: false,
                    customClass: {
                        container: 'custom-register-swal'
                    },
                    didOpen: () => {
                        $('#custom-close-button').click(function () {
                            swal.close();
                        });
                    }
                });
            })
            .catch(error => {
                showSwal('Fail!', error.response.data.msg);
            });
    })

    //--------- deskstop click wishlist btn -------------------
    $('.wishlist-button-hover').on('click', function (e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var is_wishlist = $(this).data('is-wishlist');
        var url = $(this).data('url');

        if (is_wishlist == 1) {
            $(this).find('.wishlist-hide, .wishlist-hover-show').removeClass('d-none');
            $(this).find('.wishlist-added').addClass('d-none');
            $(this).data('is-wishlist', 0);
        } else {
            $(this).find('.wishlist-hide, .wishlist-hover-show').addClass('d-none');
            $(this).find('.wishlist-added').removeClass('d-none');
            $(this).data('is-wishlist', 1);
        }

        axios({
            method: "post",
            url: url,
            data: {
                product_id: product_id,
                is_wishlist: is_wishlist,
            }
        });
    });

    //--------- mobile click wishlist btn -------------------
    $('.wishlist-button-hover-mobile').on('click', function(e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var is_wishlist = $(this).data('is-wishlist');
        var url = $(this).data('url');

        if (is_wishlist == 1) {
            $(this).find('.wishlist-mobile').removeClass('d-none');
            $(this).find('.wishlist-mobile-added').addClass('d-none');
            $(this).data('is-wishlist', 0);
        } else {
            $(this).find('.wishlist-mobile').addClass('d-none');
            $(this).find('.wishlist-mobile-added').removeClass('d-none');
            $(this).data('is-wishlist', 1);
        }

        axios({
            method: "post",
            url: url,
            data: {
                product_id: product_id,
                is_wishlist: is_wishlist,
            }
        });
    });

    //-------- wishlist remove btn on wishlist page --------------
    $('.wishlist-remove-button-hover').on('click', function (e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var url = $(this).data('url');
        var total_count_item = parseInt($('.total-count-item').text());

        $(this).parents('.product-container').remove();
        $('.total-count-item').text((total_count_item - 1) + ' Items');

        axios({
            method: "post",
            url: url,
            data: {
                product_id: product_id,
            }
        })
    });
});