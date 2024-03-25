$(function() {
    $('.cart-button-hover').on('click', function(e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var url = $(this).data('url');

        axios({
            method: "post",
            url: url,
            data: {
                product_id: product_id
            }
        })
        .then(response => {
            $('#cart-count').html(response.data.cart_count);
            
            Swal.fire({
                title: '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Success!</p>',
                html: '<p class="swal-register-content-1">Product added to cart successfully.</p> ',
                backdrop: false,
                showConfirmButton: false,
                customClass: {
                    container: 'custom-register-swal'
                },
                didOpen: () => {
                    $('#custom-close-button').click(function() {
                        Swal.close();
                    });
                }
            });
        })
        .catch(error => {
            showSwal('Fail!', error.response.data.msg);
        });
    })
});