@extends('web.layout.app')
@section('content')
<div id="programme_1">
    <div class="section-header">
        <div class="row gx-0 header-row">
            <div class="col-12 col-md-5 banner-background">
                <div class="title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item p4"><a href="/">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item p4">{{ __('Programme') }}</li>
                            <li class="breadcrumb-item active p4" aria-current="page">{{ __('Healthy Teeth Collaboration') }}</li>
                        </ol>
                    </nav>
                    <h2 class="h2">
                        {!! __('Healthy Teeth<br/>Collaboration') !!}
                    </h2>
                </div>
            </div>
            <div class="col-12 col-md-7 d-none d-md-block">
                <img src="{{ asset('assets/web/assets/img/programme/banner.png') }}" alt="" class="img img-fluid banner-img h-100">
            </div>
        </div>
    </div>
    <div class="content-section">
        <div class="m-auto">
            <div class="row d-flex align-items-center justify-content-between w-100">
                <div class="col-12 col-md-12">
                    <div class="content-wrapper m-auto mt-5 mt-md-0">
                        <h3 class="h3">{{ __('Healthy Teeth Collaboration') }}</h3>
                        <p class="p2">
                            {!! __('We are very privileged to be a designated clinic to provide dental service for the persons with intellectual disability (PID) of the Healthy Teeth Collaboration Project managed by the Department of Health.') !!}
                        </p>
                        <h4 class="h4">{{ __('Service') }}:</h4>
                        <ul class="ul">
                            <li><p class="p2">{!! __('Oral health promotion and education to caregivers') !!}</p></li>
                            <li><p class="p2">{!! __('Annual dental checkup and preventive treatment for PID') !!}</p></li>
                            <li><p class="p2">{!! __('Dental treatment necessary for PID by behavioral management, conscious sedation, MAC or general anaesthesia') !!}</p></li>
                            <li><p class="p2">{!! __('Rehabilitation service including dentures where indicated for PID') !!}</p></li>
                        </ul>
                        <h4 class="h4">{{ __('Service period') }}:</h4>
                        <ul class="ul">
                            <li><p class="p2">{!! __('16 July 2024 – 15 July 2027') !!}</p></li>
                        </ul>
                        <h4 class="h4">{{ __('Service period') }}:</h4>
                        <ul class="ul">
                            <li><p class="p2">{!! __('Adults aged 18 and above; AND') !!}</p></li>
                            <li><p class="p2">{!! __('Proof of intellectual disability by way of:') !!}</p></li>
                            <li><p class="p2">{!! __('Registration Card for People with Disabilities issued by the Labour and Welfare Bureau Medical certification') !!}</p></li>
                            <li><p class="p2">{!! __('Medical certification') !!}</p></li>
                            <li><p class="p2">{!! __('Rehabilitation service certification') !!}</p></li>
                        </ul>
                        <h4 class="h4">{{ __('Escort and transport subsidies') }}:</h4>
                        <ul class="ul">
                            <li><p class="p2">{!! __('Escort subsidy – actual expense with a maximum of $350 per dental visit and up to 6 visits per service year') !!}</p></li>
                            <li><p class="p2">{!! __('Transport subsidy – actual expense of no more than $300 per dental visit, and up to 6 visits per service year') !!}</p></li>
                        </ul>
                        <h4 class="h4">{{ __('Booking / Enquiries') }}:</h4>
                        <ul class="ul">
                            <li><p class="p2">{!! __('Call xxxx xxxx (at 9:00am to 6:00pm, Mon to Sat)') !!}</p></li>
                            <li><p class="p2">{!! __('WhatsApp xxxx xxxx') !!}</p></li>
                        </ul>
                        <h4 class="h4">{{ __('Forms Download') }}:</h4>
                        <ul class="ul">
                            <li><a href="#" class="p2">{!! __('Application Form (not required for existing patient)') !!}</a></li>
                            <li><a href="#" class="p2">{!! __('Appendices to Application Form') !!}</a></li>
                            <li><a href="#" class="p2">{!! __('Assessment Form (required for every patient every service year, i.e. 16 July – 15 July)') !!}</a></li>
                            <li><a href="#" class="p2">{!! __('Certificate of Disability Type') !!}</a></li>
                            <li><a href="#" class="p2">{!! __('Escort / Transport Fee Claim Form') !!}</a></li>
                            <li><a href="#" class="p2">{!! __('Declaration by Claimant on Transport Fee (e.g. taxi receipt)') !!}</a></li>
                            <li><a href="#" class="p2">{!! __('Statement of Relationship between Agent and Applicant') !!}</a></li>
                            <li><a href="#" class="p2">{!! __('Agreement Form of Eligibility Checking for Dental Treatment') !!}</a></li>
                            <li><a href="#" class="p2">{!! __('Attendance Record') !!}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection