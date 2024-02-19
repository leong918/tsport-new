@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.10/dist/css/tempus-dominus.css"/>
@endsection

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><strong>User</strong> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{ html()->model($model)->form('PUT', route("admin.user.update.put", ["id" => $model->id]))->open() }}

                                    @include("admin.user.fields")

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