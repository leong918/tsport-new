@if(!isset($model))
    <div class="row productPriceRow">
        <div class="col-md-5">
            <div class="mb-3">
                {{ html()->label('Currency') }}
                {{ html()->select('product_price[0][currency_id]')->options($currencyDropdown)->class('form-control')->required() }}
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                {{ html()->label('Price') }}
                {{ html()->number('product_price[0][price]')->class('form-control')->attributes(['min' => '0.01','step' => '0.01'])->required() }}
            </div>
        </div>
    </div>
@else
    @foreach($model->productPrice as $key => $productPrice)
        <div class="row productPriceRow">
            <div class="col-md-5">
                <div class="mb-3">
                    {{ html()->label('Currency') }}
                    {{ html()->select('product_price['. $key .'][currency_id]')->options($currencyDropdown)->class('form-control')->required()->value($productPrice->currency_id) }}
                </div>
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    {{ html()->label('Price') }}
                    {{ html()->number('product_price['. $key .'][price]')->class('form-control')->value($productPrice->price)->attributes(['min' => '0.01','step' => '0.01'])->required() }}
                </div>
            </div>
            @if($key != 0)
                <div class="col-md-2 position-relative d-flex justify-content-end">
                    <div class="mb-3 text-center position-absolute bottom-0 me-5">
                        <button type="button" class="btn btn-danger btn-remove"><i
                            class="fas fa-times"></i></button>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
@endif
@section('script')
@parent
<script src="https://cdn.jsdelivr.net/npm/mustache@4.2.0/mustache.min.js"></script>
<script id="priceInputContent" type="x-tmpl-mustache">
    <div class="row productPriceRow">
        <div class="col-md-5">
            <div class="mb-3">
                {{ html()->label('Currency') }}
                <select class="form-control" name="product_price[@{{ id }}][currency_id]" required>
                    @{{{ currency_dropdown }}}
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                {{ html()->label('Price') }}
                <input type="number" class="form-control"
                    name="product_price[@{{ id }}][price]" required step="0.01" min="0.01">
            </div>
        </div>
        <div class="col-md-2 position-relative d-flex justify-content-end">
            <div class="mb-3 text-center position-absolute bottom-0 me-5">
                <button type="button" class="btn btn-danger btn-remove"><i
                    class="fas fa-times"></i></button>
            </div>
        </div>
    </div>
</script>
<script type="text/javascript">
    var template = document.getElementById('priceInputContent').innerHTML;
    var product_price_count = $('.productPriceRow').length - 1;

    $('#add_product_price').on('click', function() {
        product_price_count++;
        var rendered = Mustache.render(template, {
            id: product_price_count,
            currency_dropdown: $('select[name="product_price[0][currency_id]"]').html(),
        });

        $(this).parents('.card').find('.priceInputWrapper').append(rendered);
    })

    $('body').on('click', '.btn-remove', function() {
        $(this).parents('.productPriceRow').remove();
    })
</script>
@endsection