@extends('web.layout.app')
@section('content')
<section id="how" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{asset('assets/web/assets/img/how_to/bg.png')}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">How To</div>
            <div class="nav-acc"><a href="#">Home</a> > <a href="#"> How To</a></div>
        </div>
    </div>
    <div class="about-content">
        <div class="container-top">
            <div class="row-about-content">
                <div class="text-center title-about-membership">
                    下單及享用優惠教學
                </div>
                <div class=" container steps-slick">
                    <div class="slick-slider steps-wrapper">
                        <div class="item-steps">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-12">
                                        <div class="steps-num">Step. 1</div>
                                        <div class="steps-desc">
                                            在Menu中click【Login】,按【Register】,先註冊帳戶。請注意,設定帳戶密碼
                                            時,密碼強度必須要達到中級強度或以上,如果系統別到密碼強度為弱,將不能成功
                                            註冊成為會員。
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12 img-qr">
                                        <img src="{{asset('assets/web/assets/img/how_to/1.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-steps">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-12">
                                        <div class="steps-num">Step. 2</div>
                                        <div class="steps-desc">
                                            註冊帳戶及已是登入的狀態,才可於本網站下單。本網站不接受沒有註冊帳戶的訪客 下單。
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12 img-qr">
                                        <img src="{{asset('assets/web/assets/img/how_to/2.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-steps">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-12">
                                        <div class="steps-num">Step. 3</div>
                                        <div class="steps-desc">
                                        如果在沒有登入的狀態下而將產品加入購物車,已有賬戶的會員可以於結帳前再登入
                                        帳戶。未有註冊和登入帳戶的狀態下將產品加入購物車,系統會要求用戶於結帳前先
                                        註冊帳戶。
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12 img-qr">
                                        <img src="{{asset('assets/web/assets/img/how_to/3.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-steps">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-12">
                                        <div class="steps-num">Step. 4</div>
                                        <div class="steps-desc">
                                            如欲結算下單,請按右上角的購物車Icon進入購物車頁面。
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12 img-qr">
                                        <img src="{{asset('assets/web/assets/img/how_to/4.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-steps">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-12">
                                        <div class="steps-num">Step. 5</div>
                                        <div class="steps-desc">
                                            進入購物車頁面後,系統會根據你的會員級別,自動為你apply會員coupon (Auto- apply),Insider級別會員可享正價貨品95折優
                                            惠,Core級別會員可享有正價貨品9折優 惠,詳細扣減之優惠銀碼可以於【Cart totals】查閱。如正值推廣活動優惠期間,系 統亦
                                            會根據你購物車內的產品,自動為你apply活動優惠coupon (Auto-apply)。如你過 往曾經消費而有積分可以使用,系統會於上方
                                            自動顯示你可以redeem的points,請務 必自行【Apply Discount】。
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12 img-qr">
                                        <img src="{{asset('assets/web/assets/img/how_to/5.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-steps">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-12">
                                        <div class="steps-num">Step. 6</div>
                                        <div class="steps-desc">
                                            當你確定訂單已apply了所有可使用的coupons及discount後,便可click 【PROCEED TO CHECKOUT】。
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12 img-qr">
                                        <img src="{{asset('assets/web/assets/img/how_to/6.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-steps">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-12">
                                        <div class="steps-num">Step. 7</div>
                                        <div class="steps-desc">
                                            填寫Shipping Details,揀選Shipping method,最後付款便可。
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12 img-qr">
                                        <img src="{{asset('assets/web/assets/img/how_to/7.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="text-center title-about-membership">
                常見問題
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
                                    如果我曾於門市或Whatsapp下單,並已經成為會員,於此網站以電郵註冊成為會員後,系統是否會識別到我的會籍並即時自動為我升級為Insider或Core?
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
                                我過往於門市或Whatspp下單所賺取得到的積分,是否可以於此網站下單時使用?
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
                                    <p>否,於門市或Whatspp下單所賺取得到的積分,只適用於下次在門市或Whatapp下單時使用。同樣,網站下單所賺取得到的積分,亦只能於網站使用。</p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-top container-how-to-rules">
            <div class="container">
                <div class="row row-about-content">
                    <div class="col-lg-6 col-12">
                        <div class="right-content">
                            <img src="{{asset('assets/web/assets/img/how_to/img.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 left-content-wrap">
                        <div class="left-content">
                            <div class="left-chinese">
                                <p>引進成分高效 、純淨的全天然品牌</p>
                                <p>無毒 、無害、 無動物測試是我們對產品的堅持</p>
                            </div>
                            <p>
                                <ol>
                                    <li>
                                        必須於登入的狀態下才於本網站下單及享有優惠。
                                    </li>
                                    <li>
                                        客人因任何原因沒有apply coupon(s)及/或因任何原因沒有redeem points,我們
                                        不會接受取消訂單及不會安排退款。
                                    </li>
                                    <li>
                                        如有任何爭議,Tag Concept保留一切最終決定權。
                                    </li>
                                </ol>
                            </p>
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
    $('.steps-wrapper').slick({
        slidesToShow: 1,
        infinite: false,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        adaptiveHeight: true
    })
</script>
@endpush