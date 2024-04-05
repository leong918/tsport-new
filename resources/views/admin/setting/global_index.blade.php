@extends('admin.layout.app')

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    <div class="col-sm-6">
                        {{ html()->model($setting_model)->form('POST', route('admin.setting.updateGlobalSetting.post'))->open() }}
                        <div class="card mb-3">
                            <div class="card-header"><strong>Global Setting</strong></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    {{ html()->label('Spend Amount') }}
                                    {{ html()->text('spend_amount')->placeholder('Enter Spend Amount')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Point Earn') }}
                                    {{ html()->text('point_earn')->placeholder('Enter Point Earn')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Point Redemption Ratio (1 Point : $ XX)') }}
                                    {{ html()->text('point_redemption_ratio')->placeholder('Enter Point Redemption Ratio')->class('form-control') }}
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                    <div class="col-sm-6">
                        {{ html()->model($setting_model)->form('POST', route('admin.setting.updateGlobalSetting.post'))->open() }}
                        <div class="card mb-3">
                            <div class="card-header"><strong>Sender Details</strong></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    {{ html()->label('First Name') }}
                                    {{ html()->text('sender_first_name')->placeholder('Enter Sender First Name')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Last Name') }}
                                    {{ html()->text('sender_last_name')->placeholder('Enter Sender Last Name')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Phone No') }}
                                    {{ html()->text('sender_phone_no')->placeholder('Enter Sender Phone No')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Address') }}
                                    {{ html()->text('sender_address')->placeholder('Enter Sender Address')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('City') }}
                                    {{ html()->text('sender_city')->placeholder('Enter Sender City')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('State') }}
                                    {{ html()->text('sender_state')->placeholder('Enter Sender State')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Country') }}
                                    {{ html()->text('sender_country')->placeholder('Enter Sender Country')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Postcode') }}
                                    {{ html()->text('sender_postcode')->placeholder('Enter Sender Postcode')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Email') }}
                                    {{ html()->text('sender_email')->placeholder('Enter Sender Email')->class('form-control') }}
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
