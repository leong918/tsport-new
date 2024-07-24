@extends('admin.layout.app')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a class="nav-link" href="{{ route('admin.admin.index') }}">Admin</a>
    </li>
    <li class="breadcrumb-item active"><span>Update</span></li>
@endsection

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><strong>Admin</strong> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{ html()->model($model)->form('PUT', route("admin.admin.update.put", ["id" => $model->id]))->open() }}

                                    @include("admin.admin.fields")

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