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
            </div>
            <div class="panel section-4">
            </div>
            <div class="panel section-5">
            </div>
            <div class="panel section-6">
            </div> --}}
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

                                    {{-- <div class="row justify-content-center g-3">
                                        <div class="col-12 col-md-8">
                                            <div class="card shadow-sm border-0">
                                                <div class="card-body">
                                                    <label for="home-comment" class="form-label">想说点什么？</label>
                                                    <div class="input-group">
                                                        <input type="text" id="home-comment" class="form-control"
                                                            placeholder="输入留言" aria-label="输入留言">
                                                        <button class="btn btn-primary" type="button">发表留言</button>
                                                    </div>
                                                    <small class="text-muted d-block mt-2">提示：留言后即可参与每周抽奖活动</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
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
                    <img src="{{ asset('assets/web/images/home/section-7/ip.png') }}" alt="IP Element" class="img-fluid">
                </div>
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
