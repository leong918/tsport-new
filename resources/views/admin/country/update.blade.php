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
                                    {{ html()->model($model)->form('PUT', route("admin.country.update.put", ["id" => $model->id]))->open() }}

                                    @include("admin.country.fields")

                                    {{ html()->form()->close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection