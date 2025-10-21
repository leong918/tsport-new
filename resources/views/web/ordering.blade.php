@extends('web.layout.app')

@section('content')
    <div id="page-ordering" class="screen">
        {{-- Header Section --}}
        <section id="section-title">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="title-img">
                            <img src="{{ asset('assets/web/images/ordering/title.png') }}" alt="Ordering Title"
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Recommendations Section --}}
        <section id="section-recommendations" class="recommendations-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="recommendations-content">
                            <div class="recommendations-title">
                                <img src="{{ asset('assets/web/images/ordering/prediction-boarder.png') }}"
                                    alt="Prediction Border" class="img-fluid">
                            </div>
                            <div class="recommendations-wrapper">
                                <div class="recommendation-item">
                                    <img src="{{ asset('assets/web/images/ordering/prediction-ip1.png') }}"
                                        alt="Prediction 1" class="img-fluid">
                                </div>
                                <div class="recommendation-item">
                                    <img src="{{ asset('assets/web/images/ordering/prediction-ip2.png') }}"
                                        alt="Prediction 2" class="img-fluid">
                                </div>
                                <div class="recommendation-item">
                                    <img src="{{ asset('assets/web/images/ordering/prediction-ip3.png') }}"
                                        alt="Prediction 3" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Chef Character Section --}}
        <section id="section-chef-character">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="chef-wrapper">
                            <div class="chef-character">
                                <div class="chef-placeholder">
                                    <img src="{{ asset('assets/web/images/ordering/ip.png') }}" alt="Chef Character"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <div class="chef-chatbox-wrapper">
                            <div class="chef-speech-bubble">
                                <p>老闆，今天想吃什麼好料？</p>
                            </div>
                            <div class="chef-chatbox">
                                <img src="{{ asset('assets/web/images/ordering/chatbox.png') }}" alt="Chat Box"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn-view-all">
                <img src="{{ asset('assets/web/images/button/btn-more.png') }}" alt="View All" class="img-fluid">
            </button>
        </section>
    </div>
@endsection
