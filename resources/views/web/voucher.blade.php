@extends('web.layout.app')
@section('content')
<section id="voucher" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{asset('assets/web/assets/img/voucher/bg.png')}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Voucher</div>
            <div class="nav-acc"><a href="#">Home</a> > <a href="#"> Voucher</a></div>
        </div>
    </div>
    <div class="about-content">
        <div class="container">
            <div class="row row-about-content">
                <div class="col-12">
                    <div class="text-center title-about-membership">
                        消費券<br/>
                        Consumption Voucher
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
                                    Tag Concept 網站(www.tag-concept.com)接受什麼形式支付的消費券?
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
                                        <div class="row">
                                            <div class="col-lg-7 col-12">
                                                <p>
                                                    於此網站下單,我們接受以Tap & Go及支付寶HK的方式收取消費券。請注意一張訂單只接受以一個支 付方式付款,如你的訂單超過消費金額,請自行於Tap & Go或支付寶HK充值足夠金額,或連結你的 銀行帳戶及信用卡,以進行一次性付款。
                                                    我們不接受一張訂單分開兩個或以上的支付方式(包括銀行 轉帳及FPS)
                                                </p>
                                                <p>
                                                    <ul>
                                                        <li>
                                                            Tap & Go:Checkout時,輸入已登記的Tap & Go Mastercard資料付款即可。 詳細步驟:
                                                            <ol>
                                                                <li>
                                                                    打開Tap & Go App
                                                                </li>
                                                                <li>
                                                                    點選Mastercard icon
                                                                </li>
                                                                <li>
                                                                    輸入6-digit PIN
                                                                </li>
                                                                <li>
                                                                    App會顯示Tap & Go MasterCard Number, CVC2/CVV pin及expiry date
                                                                </li>
                                                                <li>
                                                                    copy and paste以上資料於website進行付款
                                                                </li>
                                                            </ol>
                                                        </li>
                                                        <li>
                                                            支付寶HK:以下是我們的支付寶HK收款QR Code (Great Fancy Ltd.)
                                                        </li>
                                                    </ul>
                                                </p>
                                            </div>
                                            <div class="col-lg-5 col-12">
                                                <div class="img-qr">
                                                    <img src="{{asset('assets/web/assets/img/voucher/qr.png')}}" alt="">
                                                </div>
                                            </div>
                                        </div>
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
                                    Tag Concept 門市接受什麼形式支付的消費券?
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
                                        <p>荔枝角門市:接受以Tap & Go及支付寶HK的方式收取消費券</p>
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