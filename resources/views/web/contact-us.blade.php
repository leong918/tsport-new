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
                        <a href="tel:(852) 2868 3808">
                            <div class="contact-list-item">
                                <div class="contact-icon">
                                    <img src="{{ asset('assets/web/assets/img/contact-us/phone-icon.png') }}" alt="">
                                </div>
                                <div class="contact-content">
                                    <p class="p2">(852) 2868 3808</p>
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

                        <a href="https://maps.app.goo.gl/AfaUt929wKPkKSeT7" target="_blank">
                            <div class="contact-list-item">
                                <div class="contact-icon">
                                    <img src="{{ asset('assets/web/assets/img/contact-us/location-icon.png') }}" alt="">
                                </div>
                                <div class="contact-content">
                                    <u class="p2">
                                        1901-1906 T.O.P, 700 Nathan Road, Mongkok, Kowloon
                                    </u>
                                </div>
                            </div>
                        </a>
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
                if (error.response && error.response.data && error.response.data.errors) {
                    const errors = error.response.data.errors;
                    const firstErrorKey = Object.keys(errors)[0];
                    errorMessage = errors[firstErrorKey][0];
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