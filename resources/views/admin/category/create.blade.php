@extends('admin.layout.app')

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><strong>Category</strong> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{ html()->form('POST', route("admin.category.create.post"))->acceptsFiles()->id('category')->open()  }}
                                    
                                    @include("admin.category.fields")

                                    {{ html()->form()->close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                
            </div>
        </div>
    </div>
</main>
@endsection