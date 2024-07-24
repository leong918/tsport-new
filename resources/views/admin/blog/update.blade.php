@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/admin/css/tempus-dominus.css') }}"/>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a class="nav-link" href="{{ route('admin.blog.index') }}">Blog</a>
    </li>
    <li class="breadcrumb-item active"><span>Update</span></li>
@endsection

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        {{ html()->model($model)->form('PUT', route("admin.blog.update.put", ["id" => $model->id]))->acceptsFiles()->id('blog-form')->class('axios-form')->open() }}
                            @include("admin.blog.fields")
                            <div class="col-sm-12">
                                <div class="my-3 float-end">
                                    <a href="{{ route("admin.blog.index") }}" class="btn btn-warning">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection