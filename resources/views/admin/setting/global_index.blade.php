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
                                    {{ html()->label('Point Redemption Ratio (1 Point : $ XX)') }}
                                    {{ html()->text('point_redemption_ratio')->placeholder('Enter Point Redemption Ratio')->class('form-control')->required() }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Point Earned By Review') }}
                                    {{ html()->text('review_point')->placeholder('Enter Point Earned By Review')->class('form-control')->required() }}
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
