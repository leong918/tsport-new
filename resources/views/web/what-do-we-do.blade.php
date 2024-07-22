@extends('web.layout.app')
@section('content')
<div id="what-do-we-do">
    <!-- header -->
    <div class="section-header">
        <div class="row gx-0 header-row">
            <div class="col-12 col-md-6 col-lg-5  banner-background">
                <div class="title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item p4"><a href="/">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active p4" aria-current="page">{{ __('What do we do') }}</li>
                        </ol>
                    </nav>
                    <h2 class="h2">
                        {!! __('What do we do') !!}
                    </h2>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7 d-none d-md-block">
                <img src="{{ asset('assets/web/assets/img/what-do-we-do/banner.png') }}" alt="" class="img img-fluid banner-img h-100">
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="content-section">
        <div class="container">
            <div class="top-content-wrapper">
                <div class="content-wrapper">
                    <div class="content">
                        <p class="p2">
                            {{ __('Hello Smile Hong Kong is an NGO that is registered as a charity in Hong Kong under Section 88 of the Inland Revenue Ordinance to service the oral health needs of local grass-roots families, with an emphasis on young children and children with special health care needs.') }}
                        </p>
                        <p class="p2">
                            {{ __('We believe oral health is the foundation of wellbeing and happiness. An effort made for the happiness of others lifts above us. Not everyone can do great things but we can all do small things with great love.') }}
                        </p>
                    </div>
                    <div class="img-wrapper d-none d-lg-block">
                        <img src="{{ asset('assets/web/assets/img/what-do-we-do/what-do-we-do-1.png') }}" alt="" class="img img-fluid">
                    </div>
                </div>
                <div class="outer-img-wrapper d-block d-lg-none">
                    <img src="{{ asset('assets/web/assets/img/what-do-we-do/what-do-we-do-1.png') }}" alt="" class="img img-fluid">
                </div>
            </div>
            <div class="bottom-content-wrapper">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="left-section">
                            <div class="education-wrapper">
                                <h3 class="h3">{{ __('Education') }}</h3>
                                <p class="p2">
                                    {{ __('Organize educational trainings & disseminate educational information to health institutions or personnel, schools, general public to promote the importance of oral health. We advocate the importance of establishing a dental home for young children and children with special healthcare needs to promote early dental intervention and provide preventive oral health counseling.') }}
                                </p>
                            </div>
                            <img src="{{ asset('assets/web/assets/img/what-do-we-do/community.png') }}" alt="" class="img img-fluid d-none d-md-block">
                            <img src="{{ asset('assets/web/assets/img/what-do-we-do/education.png') }}" alt="" class="img img-fluid d-block d-md-none">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="right-section">
                            <img src="{{ asset('assets/web/assets/img/what-do-we-do/education.png') }}" alt="" class="img img-fluid d-none d-md-block">
                            <div class="community-wrapper">
                                <h3 class="h3">{{ __('Community Outreach') }}</h3>
                                <p class="p2">
                                    {{ __('Provide dental care screenings, oral health education, dental treatments to underserved community including young children and children with special health care needs.') }}
                                </p>
                            </div>
                            <img src="{{ asset('assets/web/assets/img/what-do-we-do/community.png') }}" alt="" class="img img-fluid d-block d-md-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- get involved -->
            <div class="involve-wrapper">
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-4">
                        <h3 class="h3 title">{{ __("Get Involved") }}</h3>
                    </div>
                    <div class="col-12 col-md-9 col-lg-8 mt-5 mt-md-0">
                        <div class="involve-detail d-flex">
                            <img src="{{ asset('assets/web/assets/img/what-do-we-do/donation.png') }}" alt="" class="img involve-img">
                            <div class="detail-content">
                                <h4 class="h4">{{ __('Donation') }}</h4>
                                <p class="p2">
                                    {{ __('Big or small, we are always grateful for donations – help us serve the oral health needs of the local community by donating today.') }}
                                </p>
                            </div>
                        </div>
                        <div class="involve-detail d-flex">
                            <img src="{{ asset('assets/web/assets/img/what-do-we-do/volunteer.png') }}" alt="" class="img involve-img">
                            <div class="detail-content">
                                <h4 class="h4">{{ __('Volunteer') }}</h4>
                                <p class="p2">
                                    {{ __('In Hello Smile Hong Kong, we offer a wide array of opportunities to give back to the society. Sign up and join us in helping out those who are in need. Your help is of paramount importance to us.') }}
                                </p>
                            </div>
                        </div>
                        <div class="involve-detail d-flex">
                            <img src="{{ asset('assets/web/assets/img/what-do-we-do/fundraise.png') }}" alt="" class="img involve-img">
                            <div class="detail-content">
                                <h4 class="h4">{{ __('Fundraise') }}</h4>
                                <p class="p2">
                                    {{ __('Fundraise to us to help spread oral health awareness and put a smile on those who are in need.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('.bio').on('show.bs.collapse', function () {
        $(this).siblings().find('.arrow-down').removeClass('down').addClass('up');
    });

    $('.bio').on('hide.bs.collapse', function () {
        $(this).siblings().find('.arrow-down').removeClass('up').addClass('down');
    });
</script>
@endpush