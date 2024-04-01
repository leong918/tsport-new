@extends('admin.layout.app')

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row mb-5">
                            {{ html()->form('POST', route('admin.product.create.post'))->acceptsFiles()->id('product')->open() }}

                            @include('admin.product.fields')

                            {{-- product attribute --}}
                            <div class="col-sm-12 product-attribute-input mt-3">
                                <div class="row mb-3">
                                    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <strong>{{ __('Product Attribute') }}</strong>
                                                <button type="button" class="btn btn-primary" id="addOptionBtn">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <div class="row" id="optionContent">
                                                    <div class="col-sm-12 optionContent" data-option-id="0">
                                                        <div class="card">
                                                            <div
                                                                class="card-header bg-light d-flex justify-content-between">
                                                                <div class="front d-flex">
                                                                    <div class="input-group" style="width: 100%">
                                                                        <input type="text" class="form-control"
                                                                            style="font-weight: bold;" required
                                                                            placeholder="{{ __('Attribute Name') }}"
                                                                            name="option[0][attribute_name]">
                                                                    </div>
                                                                </div>
                                                                <div class="back">
                                                                    <button class="btn btn-primary btn-addOption"
                                                                        type="button"><i class="fas fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item termWrapper"
                                                                    data-option-variation-id="0">
                                                                    <div class="col-md-11 col-11">
                                                                        <div
                                                                            class="d-flex flex-wrap justify-content-between">
                                                                            <div class="inputBoxes d-flex flex-wrap">
                                                                                <div class="m-2 ms-0">
                                                                                    <textarea type="text"
                                                                                        class="form-control" required
                                                                                        placeholder="{{ __('Attribute Term') }}"
                                                                                        name="option[0][variation][0][term_name]" style="height: 37px"></textarea>
                                                                                </div>
                                                                                <div class="m-2 ms-0">
                                                                                    <input type="text"
                                                                                        class="form-control" required
                                                                                        placeholder="{{ __('SKU') }}"
                                                                                        name="option[0][variation][0][term_sku]">
                                                                                </div>
                                                                                <div class="m-2 ms-0">
                                                                                    <input type="number"
                                                                                        class="form-control" required
                                                                                        min="1"
                                                                                        placeholder="{{ __('Quantity') }}"
                                                                                        name="option[0][variation][0][term_qty]">
                                                                                </div>
                                                                                <div class="m-2 ms-0">
                                                                                    <input type="number"
                                                                                        class="form-control" required
                                                                                        min="0.01"
                                                                                        step="0.01"
                                                                                        placeholder="{{ __('Add On Price') }}"
                                                                                        name="option[0][variation][0][term_add_on_price]">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="card-footer">
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <input id="attributeStatus" type="checkbox" name="option[0][attribute_status]">
                                                                    <span class="ms-2">Visible on product page</span>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <input id="is_variation" type="checkbox" name="option[0][is_variation]">
                                                                    <span class="ms-2">Used for variations</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="my-3 float-end">
                                    <a href="{{ route('admin.product.index') }}" class="btn btn-warning">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
@parent

<script id="moreOptionLayout" type="x-tmpl-mustache">
    <div class="col-sm-12 optionContent mt-3" data-option-id="@{{ id }}">
        <div class="card">
            <div class="card-header bg-light d-flex justify-content-between">
                <div class="front d-flex">
                    <div class="input-group" style="width: 100%">
                        <input type="text" class="form-control" style="font-weight: bold;" required placeholder="{{__('Attribute Name')}}" name="option[@{{id}}][attribute_name]">
                    </div>
                </div>
                <div class="back">
                    <button class="btn btn-primary btn-addOption" type="button"><i class="fas fa-plus"></i></button>
                    <button class="btn btn-danger btn-remove-option" type="button"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item termWrapper" data-option-variation-id="@{{ variation_id }}">
                    <div class="col-md-11 col-11">
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="inputBoxes d-flex flex-wrap">
                                <div class="m-2 ms-0">
                                    <textarea class="form-control" required placeholder="{{__('Attribute Term')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_name]" style="height: 37px"></textarea>
                                </div>
                                <div class="m-2 ms-0">
                                    <input type="text" class="form-control" required placeholder="{{__('SKU')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_sku]">
                                </div>
            
                                <div class="m-2 ms-0">
                                    <input type="number" class="form-control" required min="1" placeholder="{{__('Quantity')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_qty]">
                                </div>
                                <div class="m-2 ms-0">
                                    <input type="number"
                                        class="form-control" required
                                        min="0.01"
                                        step="0.01"
                                        placeholder="{{ __('Add On Price') }}"
                                        name="option[@{{id}}][variation][@{{ variation_id }}][term_add_on_price]">
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="card-footer">
                <div class="d-flex align-items-center mb-2">
                    <input type="checkbox" name="option[@{{id}}][attribute_status]">
                    <span class="ms-2">Visible on product page</span>
                </div>
                <div class="d-flex align-items-center">
                    <input type="checkbox" name="option[@{{id}}][is_variation]">
                    <span class="ms-2">Used for variations</span>
                </div>
            </div>
        </div>
    </div>
</script>

<script id="optionVariationLayout" type="x-tmpl-mustache">
    <li class="list-group-item termWrapper" data-option-variation-id="@{{ variation_id }}">
        <div class="row">
            <div class="col-md-11 col-11">
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="inputBoxes d-flex flex-wrap">
                        <div class="m-2 ms-0">
                            <textarea class="form-control" required placeholder="{{__('Attribute Term')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_name]" style="height: 37px"></textarea>
                        </div>
                        <div class="m-2 ms-0">
                            <input type="text" class="form-control" required placeholder="{{__('SKU')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_sku]">
                        </div>
                        <div class="m-2 ms-0">
                            <input type="number" class="form-control" required min="1" placeholder="{{__('Quantity')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_qty]">
                        </div>
                        <div class="m-2 ms-0">
                            <input type="number"
                                class="form-control" required
                                min="0.01"
                                step="0.01"
                                placeholder="{{ __('Add On Price') }}"
                                name="option[@{{id}}][variation][@{{ variation_id }}][term_add_on_price]">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-1 col-1 d-flex justify-content-end align-items-center">
                <div class="">
                    <button class="btn btn-danger btn-remove-variation" type="button"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
        </div>
    </li>
</script>
@endsection
