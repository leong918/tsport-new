@extends('admin.layout.app')

@section('style')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/dist/bootstrap5-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

<style>
    .editable {
        cursor: pointer;
        color: #0d6efd;
        border-bottom: 1px dashed #0d6efd;
    }
    .editable:hover {
        border-bottom: 1px dashed #0d6efd;
    }
    .editable.editing {
        border:none;
    }
</style>

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            {{ html()->model($model)->form('PUT', route("admin.sales_order.update.put", ["id" => $model->id]))->id('sales_order')->open() }}
                            <div class="card mb-3">
                                <div class="card-header"><strong>Order Details #{{ $model->sales_order_id }}</strong> </div>
                                <div class="card-body">
                                    @include("sales_order::admin.sales_order.fields")
                                </div>
                            </div>
                        </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection