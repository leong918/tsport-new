@extends('web.layout.app')
@section('content')
<div id="founder">
    <!-- header -->
    <div class="section-header">
        <div class="row gx-0 header-row">
            <div class="col-12 col-md-6 col-lg-5  banner-background">
                <div class="title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item p4"><a href="/">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item p4">{{ __('Who we are') }}</li>
                            <li class="breadcrumb-item active p4" aria-current="page">{{ __('Founder & Committee Members') }}</li>
                        </ol>
                    </nav>
                    <h2 class="h2">
                        {!! __('Founder & Committee Members') !!}
                    </h2>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7 d-none d-md-block">
                <img src="{{ asset('assets/web/assets/img/founder/banner.png') }}" alt="" class="img img-fluid banner-img h-100">
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="content-section">
        <div class="container">
            <!-- founder -->
            <div class="founder-wrapper content-wrapper">
                <h3 class="h3 text-center title">{{ __('Our Founders') }}</h3>
                <div class="row details">
                    <div class="col-12 col-sm-3">
                        <div class="img-wrapper d-flex justify-content-center">
                            <img src="{{ asset('assets/web/assets/img/founder/irene.png') }}" alt="" class="img img-fluid">
                        </div>
                    </div>
                    <div class="col-10 col-sm-9 mt-4 mt-md-0 mx-auto">
                        <h3 class="h3">{{ __('Dr. Irene Lau, Founder') }}</h3>
                        <div class="content">
                            <a class="p2 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapseIrene" role="button" aria-expanded="false" aria-controls="collapseIrene">
                                {{ __('View biography')}}
                                <span class="arrow ms-2">
                                    <img src="{{ asset('assets/web/assets/img/founder/arrow-down.png') }}" alt="" class="img img-fluid arrow-down">
                                </span>
                            </a>
                            <div class="collapse bio" id="collapseIrene">
                                <p class="p3">
                                    {{ __('Born in Hong Kong and raised in the United States, Dr. Irene Lau earned a Bachelor of') }}<br/><br/>
                                    {{ __('Over the years, Dr. Lau has practiced in Chicago, New York, and Beijing') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row details">
                    <div class="col-12 col-sm-3">
                        <div class="img-wrapper d-flex justify-content-center">
                            <img src="{{ asset('assets/web/assets/img/founder/richard.png') }}" alt="" class="img img-fluid">
                        </div>
                    </div>
                    <div class="col-10 col-sm-9 mt-4 mt-md-0 mx-auto">
                        <h3 class="h3">{{ __('Mr. Richard Yang, Founder') }}</h3>
                        <div class="content">
                            <a class="p2 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapseRichard" role="button" aria-expanded="false" aria-controls="collapseRichard">
                                {{ __('View biography')}}
                                <span class="arrow ms-2">
                                    <img src="{{ asset('assets/web/assets/img/founder/arrow-down.png') }}" alt="" class="img img-fluid arrow-down">
                                </span>
                            </a>
                            <div class="collapse bio" id="collapseRichard">
                                <p class="p3">
                                    {{ __('Richard was born in Taichung, Taiwan and raised in Australia.') }}<br/><br/>
                                    {{ __('He has earned Bachelor of Science (Mathematics / Information System) from University of Sydney. Later completed postgraduate studies with Graduate Diploma of Applied Finance from FINSIA Australia. He started his career within the IT industry and later transitioned over to the finance industry, where he overseas operations in an international bank.') }}<br/><br/>
                                    {{ __('As a founding partner of Hello Smile HK, the goal is to fill the gap left by the government to provide care and service to the underprivileged community.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Committee -->
            <div class="committee-wrapper content-wrapper">
                <h3 class="h3 text-center title">{{ __('Our Committee Members') }}</h3>
                <div class="row details">
                    <div class="col-12 col-sm-3">
                        <div class="img-wrapper d-flex justify-content-center">
                            <img src="{{ asset('assets/web/assets/img/founder/jack.png') }}" alt="" class="img img-fluid">
                        </div>
                    </div>
                    <div class="col-10 col-sm-9 mt-4 mt-md-0 mx-auto">
                        <h3 class="h3">{{ __('Dr. Jack Ji') }}</h3>
                        <div class="content">
                            <a class="p2 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapseJack" role="button" aria-expanded="false" aria-controls="collapseJack">
                                {{ __('View biography')}}
                                <span class="arrow ms-2">
                                    <img src="{{ asset('assets/web/assets/img/founder/arrow-down.png') }}" alt="" class="img img-fluid arrow-down">
                                </span>
                            </a>
                            <div class="collapse bio" id="collapseJack">
                                <p class="p3">
                                    {{ __('In 2017, Dr. Jack Ji earned his master in biomedical science from the University of Maryland after graduating from the University of Hong Kong. He also holds qualifications in implant periodontal prosthodontics and periodontics. In 2018, he attained Diplomate status with the American Board of Periodontology and Dental Implant Surgery. He enjoys working as a dentist and assisting individuals in gaining confidence with their smiles.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row details">
                    <div class="col-12 col-sm-3">
                        <div class="img-wrapper d-flex justify-content-center">
                            <img src="{{ asset('assets/web/assets/img/founder/committee-2.png') }}" alt="" class="img img-fluid">
                        </div>
                    </div>
                    <div class="col-10 col-sm-9 mt-4 mt-md-0 mx-auto">
                        <h3 class="h3">{{ __('Dr. Elok Cheung') }}</h3>
                        <div class="content">
                            <a class="p2 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapseElok" role="button" aria-expanded="false" aria-controls="collapseElok">
                                {{ __('View biography')}}
                                <span class="arrow ms-2">
                                    <img src="{{ asset('assets/web/assets/img/founder/arrow-down.png') }}" alt="" class="img img-fluid arrow-down">
                                </span>
                            </a>
                            <div class="collapse bio" id="collapseElok">
                                <p class="p3">
                                    {{ __('Elok has continued to pursue a career in pediatric dentistry and enroll in the specialist training program since she has earned her Bachelor of Dental Surgery in 2019. 
                                        She strongly believes that young patients should have a favorable dental experience in order to build a foundation for future oral health and awareness. The pleasant feeling that 
                                        comes from giving every youngster who comes to the clinic a bright and healthy grin endures despite the fact that every patient is unique and every interaction is different. Dentistry 
                                        has taken Elok all around the world. She received an international research award in Vietnam, performed volunteer work in Cambodia and Nepal, and took part in numerous foreign exchange 
                                        programs in countries like Australia, Spain, and France, to mention a few, to further her dentistry education. She enjoys cooking and eating in her own time and co-owns a food blog 
                                        where she shares her favourite eateries in Hong Kong and beyond.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row details">
                    <div class="col-12 col-sm-3">
                        <div class="img-wrapper d-flex justify-content-center">
                            <img src="{{ asset('assets/web/assets/img/founder/lor.png') }}" alt="" class="img img-fluid">
                        </div>
                    </div>
                    <div class="col-10 col-sm-9 mt-4 mt-md-0 mx-auto">
                        <h3 class="h3">{{ __('Dr. Loretta Yuen') }}</h3>
                        <div class="content">
                            <a class="p2 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapseLoretta" role="button" aria-expanded="false" aria-controls="collapseLoretta">
                                {{ __('View biography')}}
                                <span class="arrow ms-2">
                                    <img src="{{ asset('assets/web/assets/img/founder/arrow-down.png') }}" alt="" class="img img-fluid arrow-down">
                                </span>
                            </a>
                            <div class="collapse bio" id="collapseLoretta">
                                <p class="p3">
                                    {{ __('Dr. Loretta Yuen graduated from the University of Hong Kong\'s dental school in 2004 with the best award in General Dentistry. In 2007, she earned her postgraduate diploma in 
                                        general dental surgery. She worked as a general practitioner for over 18 years after graduating, focusing primarily on orthodontics and pediatric dentistry. Dr. Yuen is now a co-founder 
                                        of two Hong Kong multidisciplinary dental clinics. She is the Vice President of the Han Kong Association, and is dedicated to promoting the development of the economy, culture, technology, 
                                        and healthcare in Wuhan and Hong Kong. She is also a member of the Y Elites Association and has studied at the Chinese Academy of Governance in Beijing twice. Aside from delivering outstanding 
                                        dental services to Hong Kong residents, Dr. Yuen hopes to expand our high-tech dental technology and quality services throughout the Greater Bay China region in the future.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row details">
                    <div class="col-12 col-sm-3">
                        <div class="img-wrapper d-flex justify-content-center">
                            <img src="{{ asset('assets/web/assets/img/founder/caroline.png') }}" alt="" class="img img-fluid">
                        </div>
                    </div>
                    <div class="col-10 col-sm-9 mt-4 mt-md-0 mx-auto">
                        <h3 class="h3">{{ __('Dr. Caroline Mo') }}</h3>
                        <div class="content">
                            <a class="p2 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapseCaroline" role="button" aria-expanded="false" aria-controls="collapseCaroline">
                                {{ __('View biography')}}
                                <span class="arrow ms-2">
                                    <img src="{{ asset('assets/web/assets/img/founder/arrow-down.png') }}" alt="" class="img img-fluid arrow-down">
                                </span>
                            </a>
                            <div class="collapse bio" id="collapseCaroline">
                                <p class="p3">
                                    {{ __('Dr Caroline Mo was born and raised in the UK and graduated from University of Wales, College of Medicine in 2005. She continued to complete her vocational training in the UK 
                                        before deciding to take the licensing exam to work in Hong Kong. She is the co-founder of two multi-disciplinary dental clinics in Hong Kong and continues to enjoy working in the 
                                        field of general dentistry, as well as helping the underprivileged by providing dental treatment in organised "free clinics". She has a developing interest in dental sleep medicine 
                                        working with patients to help alleviate sleep problems. In her spare time she enjoys spending time with her two children cooking, travelling and pursuing outdoor activities.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- advisor -->
            <div class="founder-wrapper content-wrapper">
                <h3 class="h3 text-center title">{{ __('Honorary Advisors') }}</h3>
                <div class="row details">
                    <div class="col-12 col-sm-3">
                        <div class="img-wrapper d-flex justify-content-center">
                            <img src="{{ asset('assets/web/assets/img/founder/advisor-1.png') }}" alt="" class="img img-fluid">
                        </div>
                    </div>
                    <div class="col-10 col-sm-9 mt-4 mt-md-0 mx-auto">
                        <h3 class="h3">{{ __('Ms. Kelly Wei') }}</h3>
                        <div class="content">
                            <a class="p2 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapseKelly" role="button" aria-expanded="false" aria-controls="collapseKelly">
                                {{ __('View biography')}}
                                <span class="arrow ms-2">
                                    <img src="{{ asset('assets/web/assets/img/founder/arrow-down.png') }}" alt="" class="img img-fluid arrow-down">
                                </span>
                            </a>
                            <div class="collapse bio" id="collapseKelly">
                                <p class="p3">
                                    {{ __('Kelly works as an in-house counsel at a Hong Kong investment firm. She has two teenage boys and has become interested in children\'s dental health since her son was born with a tongue tie and suffered early childhood caries. Kelly believes that good dental health and function are essential to a person\'s overall well-being and is committed to spreading awareness and educating children about oral health issues and their links to overall health. Kelly has lived in Korea, the Philippines, and the United States and holds a J.D. and a B.A. from Smith College.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row details">
                    <div class="col-12 col-sm-3">
                        <div class="img-wrapper d-flex justify-content-center">
                            <img src="{{ asset('assets/web/assets/img/founder/sunny.png') }}" alt="" class="img img-fluid">
                        </div>
                    </div>
                    <div class="col-10 col-sm-9 mt-4 mt-md-0 mx-auto">
                        <h3 class="h3">{{ __('Mr. Wong Chi Kong Sunny') }}</h3>
                        <div class="content">
                            <a class="p2 d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapseSunny" role="button" aria-expanded="false" aria-controls="collapseSunny">
                                {{ __('View biography')}}
                                <span class="arrow ms-2">
                                    <img src="{{ asset('assets/web/assets/img/founder/arrow-down.png') }}" alt="" class="img img-fluid arrow-down">
                                </span>
                            </a>
                            <div class="collapse bio" id="collapseSunny">
                                <p class="p3">
                                    {{ __('Mr. Sunny Wong is currently the chief financial controller of a private company. He has worked as a manager for international firms such as K Line, Agility, and Mediterranean Shipping, as well as an NGO at the Hong Kong Arts Centre. Mr. Wong holds a Master of Science in Accountancy from Hong Kong Polytechnic University, is a member of the Hong Kong Institute of Certified Public Accountants, and is a fellow member of The Association of Chartered Certified Accountants. Mr. Wong has more than 20 years of worldwide logistics experience.') }}
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