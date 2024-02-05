@extends('admin.layout.app')

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            {{ html()->model($model)->form('PUT', route("admin.currency.update.put", ["id" => $model->id]))->acceptsFiles()->id('currency')->open() }}
                            <div class="card mb-3">
                                <div class="card-header"><strong>Currency</strong> </div>
                                <div class="card-body">
                                    @include("admin.currency.fields")
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
                </div>
            </div>
        </div>
    </div>
</main>
@endsection