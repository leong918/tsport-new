<div class="d-flex justify-content-between product-action-wrapper">
    <div class="product-price d-flex flex-column justify-content-center"
        data-default-price="{{ $product->price }}">
        ${{ $product->price }}
    </div>
</div>
<div class="col-6 col-lg-6">
    <form id="attributeForm">
        @foreach ($product->productAttribute->where('status', 1)->where('is_variation', 1) as $product_attribute)
            <div class="input-container mt-4 me-3">
                <input type="text" id="{{ $product_attribute->name }}" data-name="{{ $product_attribute->name }}"
                    class="attribute-input text-start" data-selected-price="0">
                <input type="hidden" name="{{ $product_attribute->id }}" class="attribute-value" />
                <ul id="{{ $product_attribute->name }}-dropdown" class="attribute-dropdown">
                    @foreach ($product_attribute->productAttributeTerm as $term)
                        <li data-point="{{ $term->point_value }}" data-id="{{ $term->id }}" data-stock="{{ $term->quantity }}"
                            data-add-on-price="{{ $term->getCurrencyParameters('HKD')->price }}">{{ $term->name }}</li>
                    @endforeach
                </ul>
                <label class="placeholder-label">
                    Choose {{ $product_attribute->name }}
                    <div class="d-flex float-end mt-1">
                        <i class='fas fa-angle-down'></i>
                    </div>
                </label>
            </div>
        @endforeach
    </form>
</div>
<div class="row action-button-wrapper">
    <div class="col-12 col-lg-6 ps-0">
        <button class="cart-button {{ $product->quantity === 0 && !$product->is_backorder ? 'cart-button-out-stock' : 'cart-button-hover' }}" data-id="{{ $product->id }}" data-url="{{ route('cart.add_to_cart') }}">
            {{ $product->quantity === 0 && !$product->is_backorder ? 'OUT OF STOCK' : 'ADD TO CART' }}
        </button>
    </div>
    <div class="col-12 col-lg-6 pe-0">
        <button class="buy-button {{ $product->quantity === 0 && !$product->is_backorder ? 'd-none' : '' }}" data-id="{{ $product->id }}" data-url="{{ route('cart.checkout') }}">BUY IT NOW</button>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        //-------- product attribute -----------------------
        $('.attribute-input').focus(function() {
            var attribute = $(this).attr('id');
            var dropdown = attribute + '-dropdown';
            $('#' + dropdown).addClass('visible');
        });

        $('.buy-button').on('click', function (e) {
            e.preventDefault();
            var product_id = $(this).data('id');
            var url = $(this).data('url');
            var attribute = {};
            console.log('here');

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

            var params = { 
                product_id: product_id,
                attribute: attribute 
            };

            window.location.href = url + '?' + jQuery.param( params );
        })

        $('.attribute-dropdown li').on('click', function() {
            var default_price = parseFloat($('.product-price').data('default-price'));
            var attribute = $(this).closest('.input-container').find('.attribute-input').attr('id');
            var dropdown = attribute + '-dropdown';
            var add_on_price = $(this).data('add-on-price');
            var selected_id = $(this).data('id');
            var stock = $(this).data('stock');

            $(this).parents('.input-container').find('.attribute-value').attr('value', selected_id);
            $('#' + attribute).val($(this).text()).data('selected-price', add_on_price).data('stock', stock);
            $('#' + dropdown).removeClass('visible');
            $('#' + attribute).trigger('paste');

            var is_out_of_stock = 0;
            $('.attribute-input').each(function() {
                var selected_price = parseFloat($(this).data('selected-price'));
                default_price += selected_price;
                if ($(this).data('stock') <= 0) {
                    is_out_of_stock = 1;
                }
            });

            if (is_out_of_stock) {
                $('.cart-button').removeClass('cart-button-hover');
                $('.cart-button').addClass('cart-button-out-stock');
                $('.cart-button').text('OUT OF STOCK');
                $('.buy-button').addClass('d-none');
            } else {
                $('.cart-button').addClass('cart-button-hover');
                $('.cart-button').removeClass('cart-button-out-stock');
                $('.cart-button').text('ADD TO CART');
                $('.buy-button').removeClass('d-none');
            }

            $('.product-price').text('$' + default_price.toFixed(2));
        });

        $('.attribute-input').on('blur', function() {
            var attribute = $(this).attr('id');
            var dropdown = attribute + '-dropdown';
            setTimeout(function() {
                if (!$('.input-container input#' + attribute).is(':focus') && !$('#' + dropdown)
                    .is(':focus')) {
                    $('#' + dropdown).removeClass('visible');
                }
            }, 100);
        });
    })
</script>
@endpush