$(function() {
    $('.cart-button-redirect').on('click', function() {
        window.location.href = $(this).data('href');
    })

    $('.cart-button-hover').on('click', function(e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var url = $(this).data('url');
        var attribute = {};

        if ($('.attribute-input').length > 0) {
            $('.attribute-input').each(function(i, obj) {
                if (!$(obj).val()) {
                    showSwal('Warning!', 'Please choose ' + obj.data('name'));
                    return false;
                }
            });

            $.each($('#attributeForm').serializeArray(), function() {
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
                    $('#custom-close-button').click(function() {
                        swal.close();
                    });
                }
            });
        })
        .catch(error => {
            showSwal('Fail!', error.response.data.msg);
        });
    })
});