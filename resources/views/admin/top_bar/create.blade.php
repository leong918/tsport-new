@extends('admin.layout.app')

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        {{ html()->text('output')->attribute('readonly', true)->placeholder('Title will be displayed here')->class('form-control text-center output')->required() }}
                                    </div>
                                </div>
                            </div>
                            {{ html()->form('POST', route("admin.top_bar.create.post"))->acceptsFiles()->id('top_bar')->open()  }}
                            <div class="card mb-3">
                                <div class="card-header"><strong>Top Navigation Bar</strong> </div>
                                <div class="card-body">
                                    @include("admin.top_bar.fields")
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="my-3 float-end">
                                <a href="{{ route("admin.top_bar.index") }}" class="btn btn-warning">Cancel</a>
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