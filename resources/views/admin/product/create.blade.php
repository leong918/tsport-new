@extends('admin.layout.app')

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row mb-5">
                        {{ html()->form('POST', route("admin.product.create.post"))->acceptsFiles()->id('product')->open()  }}
                        @include("admin.product.fields")
                        {{ html()->form()->close() }}
                    </div>
                </div>  
            </div>
        </div>
    </div>
</main>
@endsection