@extends('web.layout.app')
@section('content')
<div id="contact-us">
    <div class="section-header">
        <div class="row gx-0 header-row">
            <div class="col-12 col-md-5 banner-background">
                <div class="title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item p4"><a href="/">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active p4" aria-current="page">{{ __('Contact Us') }}</li>
                        </ol>
                    </nav>
                    <h2 class="h2">
                        {{ __('Contact Us') }}
                    </h2>
                </div>
            </div>
            <div class="col-12 col-md-7 d-none d-md-block">
                <img src="{{ asset('assets/web/assets/img/contact-us/banner.png') }}" alt="" class="img img-fluid banner-img h-100">
            </div>
        </div>
    </div>
    <div class="content-section">
        <div class="container">
            <div class="row contact-row">
                <div class="col-sm-12 col-lg-5">
                    <div class="contact-list-section">
                        <div class="contact-list-item">
                            <div class="contact-icon">
                                <img src="{{ asset('assets/web/assets/img/contact-us/phone-icon.png') }}" alt="">
                            </div>
                            <div class="contact-content">
                                <p>(852) 2868 3808</p>
                            </div>
                        </div>

                        <div class="contact-list-item">
                            <div class="contact-icon">
                                <img src="{{ asset('assets/web/assets/img/contact-us/mail-icon.png') }}" alt="">
                            </div>
                            <div class="contact-content">
                                <p>hellosmilehk@gmail.com</p>
                            </div>
                        </div>

                        <div class="contact-list-item">
                            <div class="contact-icon">
                                <img src="{{ asset('assets/web/assets/img/contact-us/location-icon.png') }}" alt="">
                            </div>
                            <div class="contact-content">
                                <u>
                                    1901-1906 T.O.P, 700 Nathan
                                    Road, Mongkok, Kowloon
                                </u>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-7">
                    <div class="top-section">
                        <div>Email us hellosmilehk@gmail.com</div>
                        <div>Please contact us via this website or email without disclosing confidential information.</div>
                    </div>
                    <div class="bottom-section">
                        <form>
                            <div class="form-section">
                                <div class="row">
                                    <div class="col-lg-6 first-name-container">
                                        <label>{{ __('First Name') }} <span>*</span></label>
                                        <input type="text" class="form-control" name="first_name" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>{{ __('Last Name') }} <span>*</span></label>
                                        <input type="text" class="form-control" name="last_name" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-section">
                                <label>{{ __('Email') }} <span>*</span></label>
                                <input type="text" class="form-control" name="email" />
                            </div>
                            <div class="form-section">
                                <label>{{ __('Message') }} <span>*</span></label>
                                <textarea class="form-control" rows="4"></textarea>
                            </div>
                            <button type="button" class="btn btn-contact btn-send" data-bs-toggle="modal" data-bs-target="#successModal">
                                {{ __('Send') }}
                                <img src="{{ asset('assets/web/assets/img/contact-us/right-icon.png') }}" alt="">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="warning-container">
                <div class="warning-title">Clinic Opening Hours during Typhoons and Black Rainstorm Warning</div>
                <div class="warning-text-list">
                    <ol>
                        <li>
                            When Typhoon No. 8 or above or Black Rainstorm warning issued by the Hong Kong Observatory is in effect, our clinics will be closed. Patients should not come to our
                            clinics. Our staff will contact you later for rescheduling your appointments.
                        </li>
                        <li>
                            Two hours after Typhoon No. 8 or above or Black Rainstorm warning is cancelled (or changed to a lower typhoon or rainstorm warning), our clinics will resume service.
                            Patients are advised to pay close attention to the latest weather forecast by the Hong Kong Observatory before they visit our clinics.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="success-title">
                        <p>{{ __('Thank You!') }}</p>
                    </div>
                    <div class="success-text">
                        <p>{{ __('Your contact form has been submitted.') }}</p>
                    </div>
                    <a class="btn btn-contact btn-back" href="{{ route('web.home') }}">
                        {{ __('Back to Home') }}
                        <img src="{{ asset('assets/web/assets/img/contact-us/right-icon.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection