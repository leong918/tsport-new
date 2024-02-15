@extends('web.layout.app')
@section('content')
<section id="about-point" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{asset('assets/web/assets/img/about_points/bg.png')}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Points To Cash Programme</div>
            <div class="nav-acc"><a href="#">Home</a> > <a href="#"> About</a> > <a href="#"> Point To Cash Programme</a></div>
        </div>
    </div>
    <div class="about-content">
        <div class="container">
            <div class="row row-about-content">
                <div class="col-12">
                    <div class="text-center title-about-membership">
                        積分優惠計劃<br/>
                        Points to Cash Programme
                    </div>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <div class="qna-title">
                                <div class="q-icon">
                                    <span>Q</span>
                                </div>
                                <div class="q-txt">
                                    Tag Concept 的積分計畫是什麼？<br/>
                                    What is Tag Concept Points to Cash Program?
                                </div>
                            </div>
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse accordion-unity collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="qna-ans">
                                <div class="a-icon">
                                        <span>A</span>
                                    </div>
                                    <div class="q-txt">
                                        <p>Tag Concept 的積分計畫是一個您可以賺取積分以享受額外扣減金額的計畫。</p>
                                        <p>每10積分，可以於下次消費當作$10使用，積分需要於半年內使用， 逾期作廢。</p>
                                        <p>賺取的積分(P)越多， 節省的錢就越多！</p>
                                        <p>
                                            10分 (P) = HK$10<br/>
                                            20分 (P) = HK$20<br/>
                                            30分 (P) = HK$30<br/>
                                            1000分 (P) = HK$1000 !!!

                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <div class="qna-title">
                                <div class="q-icon">
                                    <span>Q</span>
                                </div>
                                <div class="q-txt">
                                    如何在Tag Concept中賺取積分？<br/>
                                    How do I earn points in Tag Concept?
                                </div>
                            </div>
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse accordion-unity collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="qna-ans">
                                <div class="a-icon">
                                        <span>A</span>
                                    </div>
                                    <div class="q-txt">
                                        <p>Tag Concept 的積分計畫是一個您可以賺取積分以享受額外扣減金額的計畫。</p>
                                        <p>每10積分，可以於下次消費當作$10使用，積分需要於半年內使用， 逾期作廢。</p>
                                        <p>賺取的積分(P)越多， 節省的錢就越多！</p>
                                        <p>
                                            10分 (P) = HK$10<br/>
                                            20分(P) = HK$20<br/>
                                            30分(P) = HK$30<br/>
                                            1000分 (P) = HK$1000 !!!

                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <div class="qna-title">
                                <div class="q-icon">
                                    <span>Q</span>
                                </div>
                                <div class="q-txt">
                                    我的積分會過期嗎？<br/>
                                    Do points ever expire?
                                </div>
                            </div>
                        </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse accordion-unity collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="qna-ans">
                                <div class="a-icon">
                                        <span>A</span>
                                    </div>
                                    <div class="q-txt">
                                        <p>Tag Concept 的積分計畫是一個您可以賺取積分以享受額外扣減金額的計畫。</p>
                                        <p>每10積分，可以於下次消費當作$10使用，積分需要於半年內使用， 逾期作廢。</p>
                                        <p>賺取的積分(P)越多， 節省的錢就越多！</p>
                                        <p>
                                            10分 (P) = HK$10<br/>
                                            20分(P) = HK$20<br/>
                                            30分(P) = HK$30<br/>
                                            1000分 (P) = HK$1000 !!!

                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <div class="qna-title">
                                <div class="q-icon">
                                    <span>Q</span>
                                </div>
                                <div class="q-txt">
                                    如何查看我的積分餘額？<br/>
                                    How do I check my point balance?
                                </div>
                            </div>
                        </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse accordion-unity collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                            <div class="qna-ans">
                                <div class="a-icon">
                                        <span>A</span>
                                    </div>
                                    <div class="q-txt">
                                        <p>Tag Concept 的積分計畫是一個您可以賺取積分以享受額外扣減金額的計畫。</p>
                                        <p>每10積分，可以於下次消費當作$10使用，積分需要於半年內使用， 逾期作廢。</p>
                                        <p>賺取的積分(P)越多， 節省的錢就越多！</p>
                                        <p>
                                            10分 (P) = HK$10<br/>
                                            20分(P) = HK$20<br/>
                                            30分(P) = HK$30<br/>
                                            1000分 (P) = HK$1000 !!!

                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFifth">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifth" aria-expanded="false" aria-controls="collapseFifth">
                            <div class="qna-title">
                                <div class="q-icon">
                                    <span>Q</span>
                                </div>
                                <div class="q-txt">
                                    *積分計畫的條款及細則<br/>
                                    Terms and Conditions
                                </div>
                            </div>
                        </button>
                        </h2>
                        <div id="collapseFifth" class="accordion-collapse accordion-unity collapse" aria-labelledby="headingFifth" data-bs-parent="#accordionExample">
                            <div class="qna-ans">
                                <div class="a-icon">
                                        <span>A</span>
                                    </div>
                                    <div class="q-txt">
                                        <p>Tag Concept 的積分計畫是一個您可以賺取積分以享受額外扣減金額的計畫。</p>
                                        <p>每10積分，可以於下次消費當作$10使用，積分需要於半年內使用， 逾期作廢。</p>
                                        <p>賺取的積分(P)越多， 節省的錢就越多！</p>
                                        <p>
                                            10分 (P) = HK$10<br/>
                                            20分(P) = HK$20<br/>
                                            30分(P) = HK$30<br/>
                                            1000分 (P) = HK$1000 !!!

                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $('.accordion-item').on('click', function() {
        $('.accordion-item').css('box-shadow', 'unset');
        if (!($(this).find('.accordion-button').hasClass('collapsed'))) {
            $(this).css('box-shadow', '0px 0px 5px rgba(0, 0, 0, 0.3)');
        }
    });
</script>
@endpush