@extends('web.layout.app')
@section('content')
<div id="programme">
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
                        {{ __('Healthy Teeth Collaboration') }}
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
                    <div class="content-wrapper m-auto">
                        <h3 class="h3">{{ __('Healthy Teeth Collaboration') }}</h3>
                        <p class="p2">
                            {!! __('We are very privileged to be a designated clinic to provide dental service for the persons with intellectual disability (PID) of the Healthy Teeth Collaboration Project managed by the Department of Health.') !!}
                        </p>
                        <h4 class="h4">{{ __('Service') }}:</h4>
                        <ul class="ul">
                            <li><p class="p2">{!! __('Oral health promotion and education to PID and/ASD and caregivers') !!}</p></li>
                            <li><p class="p2">{!! __('Annual dental checkup and preventive treatment for PID and/ASD') !!}</p></li>
                            <li><p class="p2">{!! __('Dental treatment necessary for PID and/ASD by behavioral management, conscious sedation, MAC or general anaesthesia') !!}</p></li>
                            <li><p class="p2">{!! __('Rehabilitation service including dentures where indicated for PID and/ASD') !!}</p></li>
                        </ul>
                        <h4 class="h4">{{ __('Service period') }}:</h4>
                        <ul class="ul">
                            <li><p class="p2">{!! __('16 July 2024 — 31 March 2027') !!}</p></li>
                        </ul>
                        <h4 class="h4">{{ __('Target Beneficiaries') }}:</h4>
                        <ol class="ol">
                            <li><p class="p2">{!! __('Adults aged 18 or above; AND,') !!}</p></li>
                            <li><p class="p2">{!! __("Hold one of the following documents certifying the disability category as 'intellectual disability', 'mental handicap' or 'autism spectrum disability' :") !!}</p></li>
                            <ul class="ul">
                                <li><p class="p2">{!! __('a valid Registration Card for People with Disabilities issued by the Labour and Welfare Bureau; or') !!}</p></li>
                                <li><p class="p2">{!! __('a medical certificate issued by a doctor registered in Hong Kong; or') !!}</p></li>
                                <li><p class="p2">{!! __('a certificate issued by the person-in-charge of a rehabilitation service unit under the designated types of rehabilitation services.') !!}</p></li>
                            </ul>
                        </ol>
                        <h4 class="h4">{{ __('Escort and transport subsidies') }}:</h4>
                        <ul class="ul">
                            <li><p class="p2">{!! __('Escort subsidy per user: Actual expense with a cumulative ceiling of $5,800 per service period.') !!}</p></li>
                            <li><p class="p2">{!! __('Transport subsidy per user: Actual expense with a cumulative ceiling of $5,000 per service period.') !!}</p></li>
                        </ul>
                        <h4 class="h4">{{ __('Booking / Enquiries') }}:</h4>
                        <ul class="ul">
                            <li><p class="p2">{!! __('Call 38539672 (at 9:00am to 6:00pm, Mon to Sat)') !!}</p></li>
                            <li><p class="p2">{!! __('WhatsApp 59313940') !!}</p></li>
                        </ul>
                        <h4 class="h4">{{ __('Forms Download') }}:</h4>
                        <ul class="ul">
                            @if (app()->getLocale() == 'en')
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/en/(2024 Version) HTC Application Form(E)_202107 (hello smile logo).pdf') }}" target="_blank">{!! __('Application Form (not required for existing patient)') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/en/HTC Application Form(Appendix)(C)_202407.pdf') }}" target="_blank">{!! __('Appendices to Application Form') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/en/護齒同行申請人評估表 (30-7-24).pdf') }}" target="_blank">{!! __('Assessment Form (required for every patient every service year)') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/en/HTC01C-Certificate of Disability Type_202407.pdf') }}" target="_blank">{!! __('Certificate of Disability Type') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/en/Application for Escort & Transport Subsidy.pdf') }}" target="_blank">{!! __('Escort / Transport Fee Claim Form') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/en/HTC08E- Declaration on application for transport subsidy_202407.pdf') }}" target="_blank">{!! __('Declaration by Claimant on Transport Fee (e.g. taxi receipt)') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/en/HTC02E-Statment of relationship between the agent and the applicant_202407.pdf') }}" target="_blank">{!! __('Statement of Relationship between Agent and Applicant') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/en/HTC03E-Agreement form of eligibility checking for dental treatment (HTC).pdf') }}" target="_blank">{!! __('Agreement Form of Eligibility Checking for Dental Treatment') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/en/HTC09E-Attendance Record_202407.pdf') }}" target="_blank">{!! __('Attendance Record') !!}</a></p></li>
                            @elseif (app()->getLocale() == 'sc') 
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/sc/HTC Application Form(C)_202107 (hello smile logo).pdf') }}" target="_blank">{!! __('Application Form (not required for existing patient)') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/sc/HTC Application Form(Appendix)(C)_202407.pdf') }}" target="_blank">{!! __('Appendices to Application Form') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/sc/護齒同行申請人評估表 (30-7-24).pdf') }}" target="_blank">{!! __('Assessment Form (required for every patient every service year)') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/sc/HTC01C-Certificate of Disability Type_202407.pdf') }}" target="_blank">{!! __('Certificate of Disability Type') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/sc/護齒同行陪診&交通資助申請書.pdf') }}" target="_blank">{!! __('Escort / Transport Fee Claim Form') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/sc/HTC08-申請交通津貼聲明書_202407.pdf') }}" target="_blank">{!! __('Declaration by Claimant on Transport Fee (e.g. taxi receipt)') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/sc/HTC02-代理人與申請人關係聲明書_202407.pdf') }}" target="_blank">{!! __('Statement of Relationship between Agent and Applicant') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/sc/HTC03-Agreement Form of Eligibility Checking for Dental Treatment (HTC).pdf') }}" target="_blank">{!! __('Agreement Form of Eligibility Checking for Dental Treatment') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/sc/HTC09-到診記錄_202407.pdf') }}" target="_blank">{!! __('Attendance Record') !!}</a></p></li>
                            @elseif (app()->getLocale() == 'tc')
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/tc/HTC Application Form(C)_202107 (hello smile logo).pdf') }}" target="_blank">{!! __('Application Form (not required for existing patient)') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/tc/HTC Application Form(Appendix)(C)_202407.pdf') }}" target="_blank">{!! __('Appendices to Application Form') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/tc/護齒同行申請人評估表 (30-7-24).pdf') }}" target="_blank">{!! __('Assessment Form (required for every patient every service year)') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/tc/HTC01C-Certificate of Disability Type_202407.pdf') }}" target="_blank">{!! __('Certificate of Disability Type') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/tc/護齒同行陪診&交通資助申請書.pdf') }}" target="_blank">{!! __('Escort / Transport Fee Claim Form') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/tc/HTC08-申請交通津貼聲明書_202407.pdf') }}" target="_blank">{!! __('Declaration by Claimant on Transport Fee (e.g. taxi receipt)') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/tc/HTC02-代理人與申請人關係聲明書_202407.pdf') }}" target="_blank">{!! __('Statement of Relationship between Agent and Applicant') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/tc/HTC03-Agreement Form of Eligibility Checking for Dental Treatment (HTC).pdf') }}" target="_blank">{!! __('Agreement Form of Eligibility Checking for Dental Treatment') !!}</a></p></li>
                                <li><p class="p2"><a style="color:black" href="{{ asset('assets/web/assets/pdf/tc/HTC09-到診記錄_202407.pdf') }}" target="_blank">{!! __('Attendance Record') !!}</a></p></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection