@extends('admin.layout.app')

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        {{ html()->form('POST', route("admin.cart_rule.create.post"))->acceptsFiles()->id('cart_rule')->open()  }}
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header"><strong>Cart Rule</strong> </div>
                                <div class="card-body">
                                    @include("sales_order::admin.cart_rule.fields")
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="my-3 float-end">
                                <a href="{{ route("admin.cart_rule.index") }}" class="btn btn-warning">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
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