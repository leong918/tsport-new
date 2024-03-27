@extends('admin.layout.app')

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><strong>Country</strong> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{ html()->form('POST', route("admin.country.create.post"))->open() }}
                                    
                                    @include("admin.country.fields")

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