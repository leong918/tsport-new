@extends('web.layout.app')

@section('body-class', 'bg-1 no-footer no-header-height')

@section('content')
    <div id="page-home" class="screen home-page">
        <!-- Horizontal Scroll Section with Panels -->
        <section class="horizontal-scroll-wrapper">
            {{-- <div class="panel section-1">
            </div>
            <div class="panel section-2">
            </div>
            <div class="panel section-3">
            </div> --}}
            <div class="panel section-4">
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
                                        <a href="{{ route('web.predict') }}?tab=ip1" class="recommendation-item">
                                            <img src="{{ asset('assets/web/images/ordering/prediction-ip1.png') }}"
                                                alt="Prediction 1" class="img-fluid">
                                        </a>
                                        <a href="{{ route('web.predict') }}?tab=ip2" class="recommendation-item">
                                            <img src="{{ asset('assets/web/images/ordering/prediction-ip2.png') }}"
                                                alt="Prediction 2" class="img-fluid">
                                        </a>
                                        <a href="{{ route('web.predict') }}?tab=ip3" class="recommendation-item">
                                            <img src="{{ asset('assets/web/images/ordering/prediction-ip3.png') }}"
                                                alt="Prediction 3" class="img-fluid">
                                        </a>
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

                    <a href="{{ route('web.matches') }}" class="btn-view-all">
                        <img src="{{ asset('assets/web/images/button/btn-more.png') }}" alt="View All" class="img-fluid">
                    </a>
                </section>
            </div>
            <div class="panel section-5">
                <div class="panel-content">
                    <div class="floating-element s5 showcase">
                        <img src="{{ asset('assets/web/images/home/section-5/shirt-showcase.png') }}" alt="Showcase"
                            class="img-fluid">
                    </div>

                    <div class="s5-text">
                        <h3 class="fw-bold mb-2">球壇經典</h3>
                        <p class="s5-desc mb-0">
                            曼城 vs QPR（2012年5月13日）傷停補時第94分鐘，阿圭羅打入制勝球，
                            曼城3-2取勝，利亞曼聯首奪英超冠軍。
                        </p>
                    </div>
                </div>

                {{-- floating elements (section-5) --}}

                <div class="floating-element s5 rack">
                    <img src="{{ asset('assets/web/images/home/section-5/rack-event.png') }}" alt="Event Rack"
                        class="img-fluid">
                </div>
                <div class="floating-element s5 counter">
                    <img src="{{ asset('assets/web/images/home/section-5/counter.png') }}" alt="Counter"
                        class="img-fluid">
                </div>
                <a href="#" class="floating-element s5 tap" aria-label="Tap to view event">
                    <div class="s5-cta text-center">
                        <div class="title">點擊查看活動</div>
                        <div class="subtitle">Tap to View Event</div>
                    </div>
                    <img src="{{ asset('assets/web/images/home/section-5/icon-click.png') }}" alt="Tap"
                        class="img-fluid">
                </a>
            </div>

            <div class="panel section-6">
                <div class="panel-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title">
                                    <img src="{{ asset('assets/web/images/home/section-6/title.png') }}" alt="Title"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid px-0">
                        <div class="row gx-0">
                            <div class="col-12">
                                <div class="position-relative">
                                    <div class="projector-element">
                                        <img src="{{ asset('assets/web/images/home/section-6/projector.png') }}"
                                            alt="Projector Element" class="img-fluid">
                                    </div>
                                    <a href="{{ route('web.matches') }}" class="btn-go-live">
                                        <img src="{{ asset('assets/web/images/home/section-6/btn-go-live.png') }}"
                                            alt="Go Live" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- floating elements --}}
                <div class="floating-element ip">
                    <img src="{{ asset('assets/web/images/home/section-6/ip.png') }}" alt="IP Element"
                        class="img-fluid">
                </div>
            </div>
            <div class="panel section-7">
                <div class="panel-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-content">
                                    <div class="text-center mb-4">
                                        <h3 class="fw-bold mb-3">每周系统随机抽3位有留言用户<br />送RM50奖金</h3>
                                        <a href="#" class="btn-check-comment">
                                            <img src="{{ asset('assets/web/images/home/section-7/btn-check-comment.png') }}"
                                                alt="Check Comment" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- floating elements --}}
                <div class="floating-element table">
                    <img src="{{ asset('assets/web/images/home/section-7/table.png') }}" alt="Table Element"
                        class="img-fluid">
                </div>
                <div class="floating-element flower">
                    <img src="{{ asset('assets/web/images/home/section-7/flower.png') }}" alt="Flower Element"
                        class="img-fluid">
                </div>
                <div class="floating-element ip">
                    <img src="{{ asset('assets/web/images/home/section-7/ip.png') }}" alt="IP Element"
                        class="img-fluid">
                </div>

                <div class="floating-element chatbox-1">
                    <img src="{{ asset('assets/web/images/home/section-7/chatbox-1.png') }}" alt="Chatbox 1 Element"
                        class="img-fluid">
                    <p class="p1">今晚心水点睇?</p>
                </div>

                <a href="#" class="floating-element chatbox-2">
                    <img src="{{ asset('assets/web/images/home/section-7/chatbox-2.png') }}" alt="Chatbox 2 Element"
                        class="img-fluid">
                    <p class="p1">輸入留言</p>
                </a>
            </div>
            <div class="panel section-8">
                <div class="panel-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title">
                                    <img src="{{ asset('assets/web/images/home/section-8/title.png') }}" alt="Title"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="section-content">
                                    <h2 class="text-center mb-4 fw-normal">
                                        我们是一个专注于足球预测、体育直播和球迷互动的多功能平台，致力于为马来西亚足球迷提供最全面、最有趣的体验。</h2>
                                    <h2 class="text-center fw-normal">
                                        无论你是喜欢看赛前足球分析，还是爱看比赛的忠实球迷，都能在这里找到属于你的足球乐趣。让我们用足球连接彼此，共享激情！</h2>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <ul class="social-media-links">
                                    <li>
                                        <a href="#" target="_blank" class="social-link">
                                            <img src="{{ asset('assets/web/images/home/section-8/btn-facebook.png') }}"
                                                alt="Facebook" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="social-link">
                                            <img src="{{ asset('assets/web/images/home/section-8/btn-telegram.png') }}"
                                                alt="Telegram" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="social-link">
                                            <img src="{{ asset('assets/web/images/home/section-8/btn-website.png') }}"
                                                alt="Website" class="img-fluid">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- floating element --}}
                    <div class="floating-element">
                        <img src="{{ asset('assets/web/images/home/section-8/element.png') }}" alt="Floating Element"
                            class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </section>
        <div>
        </div>
    </div>
@endsection
