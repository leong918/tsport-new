@extends('admin.layout.app')

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            {{ html()->model($model)->form('PUT', route('admin.product.update.put', ['id' => $model->id]))->acceptsFiles()->id('product')->open() }}

                            @include('admin.product.fields')

                            {{-- ------------- display product attribute when attribute = 1 ---------- --}}
                            <div class="col-sm-12 product-attribute-input mt-3">
                                <div class="row mb-3">
                                    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <strong>Product Attribute</strong>
                                                <button type="button" class="btn btn-primary" id="addOptionBtn">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <div class="row" id="optionContent">
                                                    @if(count($model->productAttribute) > 0)
                                                    @foreach ($model->productAttribute as $key => $attribute)
                                                        <div class="col-sm-12 optionContent {{ count($model->productAttribute) > 0 && $key > 0 ? 'mt-4' : '' }}"
                                                            data-option-id="old-{{ $attribute->id }}">
                                                            <div class="card">
                                                                <div
                                                                    class="card-header bg-light d-flex justify-content-between">
                                                                    <div class="front d-flex">
                                                                        <div class="input-group" style="width: 100%">
                                                                            <input type="text" class="form-control"
                                                                                style="font-weight: bold;" required
                                                                                placeholder="{{ __('Product Attribute Name') }}"
                                                                                name="option[old-{{ $attribute->id }}][attribute_name]"
                                                                                value="{{ $attribute->name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="back">
                                                                        <button class="btn btn-primary btn-addOption"
                                                                            type="button"><i class="fas fa-plus"></i>
                                                                        </button>
                                                                        @if($key > 0)
                                                                        <button class="btn btn-danger btn-remove-option" type="button"><i class="fas fa-trash-alt"></i></button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <ul class="list-group list-group-flush">
                                                                    @foreach ($attribute->productAttributeTerm as $term_key => $term)
                                                                        <li class="list-group-item termWrapper d-flex align-items-center"
                                                                            data-option-variation-id="old-{{ $term->id }}">
                                                                            <div class="col-md-10 col-10">
                                                                                <div
                                                                                    class="inputBoxes d-flex flex-wrap ">
                                                                                    <div class="col-md-6 col-6 border-end">
                                                                                        <div class="m-2 ms-0">
                                                                                            <label
                                                                                                for="">Attribute
                                                                                                Term</label>
                                                                                            <textarea class="form-control" required rows="3"
                                                                                                name="option[old-{{ $attribute->id }}][variation][old-{{ $term->id }}][term_name]">{{ $term->name }}</textarea>
                                                                                        </div>
                                                                                        <div class="m-2 ms-0">
                                                                                            <label
                                                                                                for="">SKU</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                required
                                                                                                name="option[old-{{ $attribute->id }}][variation][old-{{ $term->id }}][term_sku]"
                                                                                                value="{{ $term->sku }}">
                                                                                        </div>
                                                                                        <div class="m-2 ms-0">
                                                                                            <label
                                                                                                for="">Quantity</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                required
                                                                                                name="option[old-{{ $attribute->id }}][variation][old-{{ $term->id }}][term_qty]"
                                                                                                value="{{ $term->quantity }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-5 col-5">
                                                                                        <div class="m-2 ms-2">
                                                                                            <label for="">Add On
                                                                                                Price</label>
                                                                                            <input type="number"
                                                                                                class="form-control"
                                                                                                required min="0"
                                                                                                step="0.01"
                                                                                                name="option[old-{{ $attribute->id }}][variation][old-{{ $term->id }}][term_add_on_price]"
                                                                                                value="{{ $term->getCurrencyParameters('HKD') ? $term->getCurrencyParameters('HKD')->price : 0 }}">
                                                                                        </div>
                                                                                        <div class="m-2 ms-2">
                                                                                            <label for="">Add On
                                                                                                Point</label>
                                                                                            <input type="number"
                                                                                                class="form-control"
                                                                                                required min="0"
                                                                                                name="option[old-{{ $attribute->id }}][variation][old-{{ $term->id }}][term_add_on_point]"
                                                                                                value="{{ $term->point_value }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @if($term_key > 0)
                                                                            <div class="col-md-2 col-2 d-flex justify-content-end align-items-center">
                                                                                <div class="">
                                                                                    <button class="btn btn-danger btn-remove-variation" type="button"><i class="fas fa-trash-alt"></i></button>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                <div class="card-footer">
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <input type="checkbox"
                                                                            data-checkbox="{{ $attribute->status }}"
                                                                            name="option[old-{{ $attribute->id }}][attribute_status]">
                                                                        <span class="ms-2">Visible on product
                                                                            page</span>
                                                                    </div>
                                                                    <div class="d-flex align-items-center">
                                                                        <input type="checkbox"
                                                                            data-checkbox="{{ $attribute->is_variation }}"
                                                                            name="option[old-{{ $attribute->id }}][is_variation]">
                                                                        <span class="ms-2">Used for variations</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @else
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
                                                                <li class="list-group-item termWrapper d-flex align-items-center"
                                                                    data-option-variation-id="0">
                                                                    <div class="col-md-10 col-10">
                                                                        <div class="inputBoxes d-flex flex-wrap">
                                                                            <div class="col-md-6 col-6 border-end">
                                                                                <div class="m-2 ms-0">
                                                                                    <textarea type="text" class="form-control" required placeholder="{{ __('Attribute Term') }}" rows="3"
                                                                                        name="option[0][variation][0][term_name]"></textarea>
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
                                                                                        placeholder="{{ __('Quantity') }}"
                                                                                        name="option[0][variation][0][term_qty]">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-5 col-5">
                                                                                <div class="m-2 ms-2">
                                                                                    <input type="number"
                                                                                        class="form-control" required
                                                                                        min="0" step="0.01"
                                                                                        placeholder="{{ __('Add On Price') }}"
                                                                                        name="option[0][variation][0][term_add_on_price]">
                                                                                </div>
                                                                                <div class="m-2 ms-2">
                                                                                    <input type="number"
                                                                                        class="form-control" required
                                                                                        min="0"
                                                                                        placeholder="{{ __('Add On Point') }}"
                                                                                        name="option[0][variation][0][term_add_on_point]">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-2">
                                                                        <div
                                                                            class="d-flex justify-content-end termBtnControl">
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="card-footer">
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <input id="attributeStatus" type="checkbox"
                                                                        name="option[0][attribute_status]">
                                                                    <span class="ms-2">Visible on product page</span>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <input id="is_variation" type="checkbox"
                                                                        name="option[0][is_variation]">
                                                                    <span class="ms-2">Used for variations</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
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
                    <div class="col-md-10 col-10">
                            <div class="inputBoxes d-flex flex-wrap">
                                <div class="col-md-6 col-6 border-end">
                                    <div class="m-2 ms-0">
                                        <textarea class="form-control" required placeholder="{{__('Attribute Term')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_name]" rows="3"></textarea>
                                    </div>
                                    <div class="m-2 ms-0">
                                        <input type="text" class="form-control" required placeholder="{{__('SKU')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_sku]">
                                    </div>
                                    <div class="m-2 ms-0">
                                        <input type="number" class="form-control" required placeholder="{{__('Quantity')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_qty]">
                                    </div>
                                </div>
                                <div class="col-md-5 col-5">
                                    <div class="m-2 ms-2">
                                        <input type="number"
                                            class="form-control" required
                                            min="0"
                                            step="0.01"
                                            placeholder="{{ __('Add On Price') }}"
                                            name="option[@{{id}}][variation][@{{ variation_id }}][term_add_on_price]">
                                    </div>
                                    <div class="m-2 ms-2">
                                        <input type="number"
                                            class="form-control" required
                                            min="0"
                                            placeholder="{{ __('Add On Point') }}"
                                            name="option[@{{id}}][variation][@{{ variation_id }}][term_add_on_point]">
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
    <li class="list-group-item termWrapper d-flex align-items-center" data-option-variation-id="@{{ variation_id }}">
        <div class="col-md-10 col-10">
            <div class="inputBoxes d-flex flex-wrap">
                <div class="col-md-6 col-6 border-end">
                    <div class="m-2 ms-0">
                        <textarea class="form-control" required placeholder="{{__('Attribute Term')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_name]" rows="3"></textarea>
                    </div>
                    <div class="m-2 ms-0">
                        <input type="text" class="form-control" required placeholder="{{__('SKU')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_sku]">
                    </div>
                    <div class="m-2 ms-0">
                        <input type="number" class="form-control" required placeholder="{{__('Quantity')}}" name="option[@{{id}}][variation][@{{ variation_id }}][term_qty]">
                    </div>
                </div>
                <div class="col-md-5 col-5">
                    <div class="m-2 ms-2">
                        <input type="number"
                            class="form-control" required
                            min="0"
                            step="0.01"
                            placeholder="{{ __('Add On Price') }}"
                            name="option[@{{id}}][variation][@{{ variation_id }}][term_add_on_price]">
                    </div>
                    <div class="m-2 ms-2">
                        <input type="number"
                            class="form-control" required
                            min="0"
                            placeholder="{{ __('Add On Point') }}"
                            name="option[@{{id}}][variation][@{{ variation_id }}][term_add_on_point]">
                    </div>  
                </div> 
            </div>
        </div>
        <div class="col-md-2 col-2 d-flex justify-content-end align-items-center">
            <div class="">
                <button class="btn btn-danger btn-remove-variation" type="button"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
    </li>
</script>
@endsection
