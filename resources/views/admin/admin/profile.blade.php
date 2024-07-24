@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/admin/css/password-meter.css') }}" />
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active"><span>Profile</span></li>
@endsection

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    <div class="col-sm-4 text-dark">
                        <h5>Profile Information</h5>
                        <p>Update your account's profile information and username.</p>
                    </div>
                    <div class="col-sm-8">
                        <div class="card">
                            {{ html()->model(auth('admin')->user())->form('POST', route("admin.admin.updateProfile"))->open() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            {{ html()->label('Name') }}
                                            {{ html()->text('name')->placeholder('Enter name')->class('form-control')->required() }}
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            {{ html()->label('Username') }}
                                            {{ html()->text('username')->placeholder('Enter username')->class('form-control')->required() }}
                                            @error('username')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
                <hr class="text-dark mt-5 mb-5"/>
                <div class="row">
                    <div class="col-sm-4 text-dark">
                        <h5>Update Password</h5>
                        <p>Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    <div class="col-sm-8">
                        <div class="card">
                            {{ html()->model(auth('admin')->user())->form('POST', route("admin.admin.updatePassword"))->open() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            {{ html()->label('Current Password') }}
                                            {{ html()->password('current_password')->placeholder('Enter password')->class('form-control')->required() }}
                                            @error('current_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3 position-relative">
                                            {{ html()->label('Password') }}
                                            {{ html()->password('password')->placeholder('Enter password')->class('form-control')->required() }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            {{ html()->label('Confirm Password') }}
                                            {{ html()->password('password_confirmation')->placeholder('Enter password confirmation')->class('form-control')->required() }}
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="confirmPasswordModal" tabindex="-1" aria-labelledby="confirmPasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-dark">
                            <h5>Confirm Password</h5>
                            <p>For your security, please confirm your password to continue.</p>
                            <div class="row">
                                <div class="col-sm-8">
                                    {{ html()->password('two_fa_password')->class('form-control')->required() }}
                                    <small id="two_fa_password_error" class="text-danger"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-close-modal" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="btn-submit-modal" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
@parent
<script src="{{ asset('assets/admin/js/password-meter.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-close-modal').on('click', function() {
            $('#confirmPasswordModal').modal('hide');
        })
    })
</script>
@endsection