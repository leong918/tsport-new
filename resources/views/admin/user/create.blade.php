@extends('admin.layout.app')

{{-- @section('style')
    @parent
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.10/dist/css/tempus-dominus.css"/>
@endsection --}}

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                        {{ html()->form('POST', route("admin.user.create.post"))->open() }}
                        <div class="card mb-5">
                            <div class="card-header"><strong>User Info</strong> </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include("admin.user.fields")
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"><strong>User Level</strong> </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include("admin.user.level_fields")
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 float-end">
                            <a href="{{ route("admin.user.index") }}" class="btn btn-warning">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>     
            </div>
        </div>
    </div>
</main>
@endsection