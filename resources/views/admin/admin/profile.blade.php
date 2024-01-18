@extends('admin.layout.app')

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><strong>{{__('page.Reset Password')}}</strong> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{ Form::model(["url" => route("admin.admin.profile"), "method" => "POST"]) }}
                                    <x-alert />
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {{ Form::label('password', __('page.New Password')) }}
                                                {{ Form::password("password", ["class" => "form-control", "required" => "required", "placeholder" => __("page.Enter new password")]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {{ Form::label('password_confirmation', __('page.Confirm Password')) }}
                                                {{ Form::password("password_confirmation", ["class" => "form-control", "required" => "required", "placeholder" => __("page.Confirm Password")]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group text-right">
                                                <a href="{{ route("admin.dashboard") }}"
                                                    class="btn btn-warning">{{__('page.Cancel')}}</a>
                                                <button type="submit"
                                                    class="btn btn-info">{{__('page.Update')}}</button>
                                            </div>
                                        </div>

                                        {{ Form::close() }}
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