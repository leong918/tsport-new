@extends('admin.layout.app')

@section('style')
    @parent
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.0.0-rc.1/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-styrHw5ARomA8xPUVXJSXXchmA9xX4sqIeUqZtGkcT2zBp/DidIW1GYUNVO5FbmJ" crossorigin="anonymous">
@endsection


@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        {{ html()->model($model)->form('PUT', route("admin.product.update.put", ["id" => $model->id]))->acceptsFiles()->id('product')->open() }}
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header"><strong>product</strong> </div>
                                <div class="card-body">
                                    @include("admin.product.fields")
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Product Price</strong> 
                                            <button type="button" id="add_product_price" class="btn btn-primary permission float-end">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="card-body priceInputWrapper">
                                            @include("admin.product.price_fields")
                                        </div>
                                    </div>
                                </div>  
                            </div>  
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header"><strong>English</strong> </div>
                                        <div class="card-body">
                                            @include("admin.product.en_fields")
                                        </div>
                                    </div>
                                </div>                        
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header"><strong>Chinese</strong></div>
                                        <div class="card-body">
                                            @include("admin.product.cn_fields")
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="my-3 float-end">
                                <a href="{{ route("admin.category.index") }}" class="btn btn-warning">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>


                        {{ html()->form()->close() }}
                    </div>
                </div>
                <!-- /.col-->
                
            </div>
        </div>
    </div>
</main>
@endsection