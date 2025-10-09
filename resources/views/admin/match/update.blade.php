@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/admin/css/tempus-dominus.css') }}" />
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a class="nav-link" href="{{ route('admin.match.index') }}">Match</a>
    </li>
    <li class="breadcrumb-item active"><span>Update</span></li>
@endsection

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            {{ html()->model($model)->form('PUT', route('admin.match.update.put', ['id' => $model->id]))->acceptsFiles()->id('match-form')->class('axios-form')->open() }}
                            @include('admin.match.fields')
                            <div class="col-sm-12">
                                <div class="my-3 float-end">
                                    <a href="{{ route('admin.match.index') }}" class="btn btn-warning">Cancel</a>
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
