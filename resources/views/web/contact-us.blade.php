@extends('web.layout.app')
@section('u_meta')
    <meta name="url" content="{{ route('web.contact-us') }}">
    <meta name="description" content={{ __('ContactUsDesc')}}>
    <title>{{'Hello Smile Hong Kong | ' .  __('Contact Us')  }}</title>
@endsection
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
                        <a href="tel:(852) 3853 9672">
                            <div class="contact-list-item">
                                <div class="contact-icon">
                                    <img src="{{ asset('assets/web/assets/img/contact-us/phone-icon.png') }}" alt="">
                                </div>
                                <div class="contact-content">
                                    <p class="p2">(852) 3853 9672</p>
                                </div>
                            </div>
                        </a>

                        <a href="mailto:hellosmilehk@gmail.com">
                            <div class="contact-list-item">
                                <div class="contact-icon">
                                    <img src="{{ asset('assets/web/assets/img/contact-us/mail-icon.png') }}" alt="">
                                </div>
                                <div class="contact-content">
                                    <p class="p2">hellosmilehk@gmail.com</p>
                                </div>
                            </div>
                        </a>
                        <div class="contact-list-item d-flex">
                            <div class="contact-icon">
                                <img src="{{ asset('assets/web/assets/img/contact-us/location-icon.png') }}" alt="">
                            </div>
                            <div class="d-flex row mx-1">
                                <a class="mb-3" href="https://maps.app.goo.gl/AfaUt929wKPkKSeT7" target="_blank">
                                    <div class="contact-content">
                                        <div class="h6">
                                            {{__('Clinic Area1')}}
                                        </div>
                                        <div class="p2">
                                            <p>
                                                ({{ __('T.O.P Dental by family smile') }})
                                                <br/>
                                                <u>
                                                    {!! __('Clinic Address1') !!}
                                                </u>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <a class="mb-3" href="https://maps.app.goo.gl/r488ySxrNVo5ZeKv8" target="_blank">
                                    <div class="contact-content col-">
                                        <div class="h6">
                                            {{__('Clinic Area2')}}
                                        </div>
                                        <div class="p2">
                                            <p>
                                                <u>
                                                    {!! __('Clinic Address2') !!}
                                                </u>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-7">
                    <div class="top-section">
                        <div class="p2">
                            {{ __('Email us hellosmilehk@gmail.com') }}
                        </div>
                        <div class="p2">
                            {{ __('Please contact us via this website or email without disclosing confidential information.') }}
                        </div>
                    </div>
                    <div class="bottom-section">
                        <form id="contact-form" action="{{ route('web.send-contact') }}" method="POST">
                            @csrf
                            <div class="form-section">
                                <div class="row">
                                    <div class="col-lg-6 first-name-container">
                                        <label class="p2">{{ __('First Name') }} <span>*</span></label>
                                        <input type="text" class="form-control" name="first_name" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="p2">{{ __('Last Name') }} <span>*</span></label>
                                        <input type="text" class="form-control" name="last_name" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-section">
                                <label class="p2">{{ __('Email') }} <span>*</span></label>
                                <input type="text" class="form-control" name="email" />
                            </div>
                            <div class="form-section">
                                <label class="p2">{{ __('Message') }} <span>*</span></label>
                                <textarea class="form-control" rows="4" name="message"></textarea>
                            </div>
                            <div class="form-section">
                                <label class="p2">{{ __('Captcha') }} <span>*</span></label>
                                <div class="row">
                                    <div class="col-5 col-lg-3">
                                        <div class="input-group">
                                            <input class="form-control" name="captcha" type="text">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="d-flex align-items-center h-100">
                                            <img src="{{Captcha::src('flat')}}" class="img-fluid captcha-img me-3" />
                                            <span id="refresh" style="cursor: pointer;">
                                                <i class="fa fa-refresh"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-contact btn-send p2">
                                {{ __('Send') }}
                                <img src="{{ asset('assets/web/assets/img/contact-us/right-icon.png') }}" alt="">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="warning-container">
                <div class="warning-title">
                    <h4 class="h4">{{ __('Clinic Opening Hours during Typhoons and Black Rainstorm Warning') }}</h4>
                </div>
                <div class="warning-text-list">
                    <ol>
                        <li>
                            <p class="p3">
                                {{ __('When Typhoon No. 8 or above or Black Rainstorm warning issued by the Hong Kong Observatory is in effect, our clinics will be closed. Patients should not come to our clinics. Our staff will contact you later for rescheduling your appointments.') }}
                            </p>
                        </li>
                        <li>
                            <p class="p3">
                                {{ __('Two hours after Typhoon No. 8 or above or Black Rainstorm warning is cancelled (or changed to a lower typhoon or rainstorm warning), our clinics will resume service. Patients are advised to pay close attention to the latest weather forecast by the Hong Kong Observatory before they visit our clinics.') }}
                            </p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#refresh').on('click', function () {
            var captcha = $('img.captcha-img');
            var config = captcha.data('refresh-config');
            axios.get('{{ route('captcha') }}')
                .then((response) => {
                    captcha.prop('src', response.data);
                })
        });

        $('#contact-form').on('submit', function (e) {
            e.preventDefault();

            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);

            let formData = new FormData(this);

            axios.post(this.action, formData)
            .then(response => {
                swal.fire({
                    title: '{{ __('Thank You!') }}',
                    text: '{{ __('Your contact form has been submitted.') }}',
                    width: 450,
                    confirmButtonText: `{{ __('Back to Home') }} <img src="{{ asset('assets/web/assets/img/contact-us/right-icon.png') }}" alt="{{ __('Back to Home') }}">`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route('web.home') }}';
                    }
                });
                this.reset();
                submitButton.prop('disabled', false);
            })

            .catch(error => {
                let errorMessage = '{{ __('An error occurred while submitting the form. Please try again.') }}';
                if (error.response && error.response.data) {
                    if (error.response.data.errors) {
                        const errors = error.response.data.errors;
                        const firstErrorKey = Object.keys(errors)[0];
                        errorMessage = errors[firstErrorKey][0];
                    } else {
                        errorMessage = error.response.data;
                    }
                }
                swal.fire({
                    title: '{{ __('Error!') }}',
                    text: errorMessage,
                    width: 450,
                });
                submitButton.prop('disabled', false);
            });
        });
    })
</script>
@endpush