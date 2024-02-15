@extends('web.layout.app')
@section('content')
<section id="about-membership" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{asset('assets/web/assets/img/about_membership/bg.png')}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Membership</div>
            <div class="nav-acc"><a href="#">Home</a> > <a href="#"> About</a> > <a href="#"> Membership</a></div>
        </div>
    </div>
    <div class="about-content">
        <div class="container">
            <div class="row row-about-content">
                <div class="col-12">
                    <div class="text-center title-about-membership">
                        會員制度<br/>
                        Tag Concept Membership
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="member-type">
                        <span>Just Member</span>
                    </div>
                    <div class="member-type-detail">
                        <p>
                            (1) 初級級別：JUST MEMBER
                            只需註冊， 您就可以成為JUST MEMBER!
                        </p>
                        <p>
                            您有資格：
                            <ul>
                                <li>
                                    註冊以賺取10積分並在第一次下單時即可使用
                                </li>
                                <li>
                                    JUST MEMBER 的消費訂單不能賺取積分
                                </li>
                            </ul>
                        </p>
                        <p>
                          Tier 1 : JUST MEMBER
                          you will become a JUST MEMBER for just sign up!  
                        </p>
                        <p>
                            You are eligible to:
                            <ul>
                                <li>
                                    earn 10 points from sigining up and redeem it on the first order.
                                </li>
                                <li>
                                    JUST MEMBER is not allowed to earn points by placing order.
                                </li>
                            </ul>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="member-type">
                        <span>Insider</span>
                    </div>
                    <div class="member-type-detail">
                        <p>
                            (2) 中級級別：INSIDER
                            一張訂單一次超過$1000即可由JUST MEMBER成為INSIDER
                        </p>
                        <p>
                            您有資格：
                            <ul>
                                <li>
                                    購物以賺取和兌換積分（以JUST MEMBER 身份首次下單，訂單滿$1000 可即時為享有INSIDER的95折優惠， 但不可賺取積分。由第二張訂單開始， 系統識別到帳戶級別已升級為 INSIDER後，才可賺取積分。）
                                </li>
                                <li>
                                    所有原價商品可享95折優惠
                                </li>
                                <li>
                                    在您的生日月份購買所有原價商品可享一次性10折優惠<br/>
                                    (请会员WHATSAPP 54425298 联络客服获取生日优惠 COUPON CODE)
                                </li>
                                <li>
                                    成為INSIDER後，如果您在一年內消費超過HK$5000，會員資格將自動再延長一年。 一年內消費少於$5000，會員資格會失效。
                                </li>
                            </ul>
                        </p>
                        <p>
                          Tier (2) : INSIDER
                          you will become an INSIDER from JUST MEMBER after spending over $1000 on ONE order
                        </p>
                        <p>
                            You are eligible to:
                            <ul>
                                <li>
                                    earn and redeem points (You will not earn any points when placing your first order as a Just Member even it is over $1000.
                                    You will be able to earn points starting from your second order when our system has upgraded your status to INSIDER.)
                                </li>
                                <li>
                                    enjoy 5% OFF discount on products at original price(Discount will be orffered if your first order is over $1000 as yoy will be considered as NEW-INSIDER.)
                                </li>
                                <li>
                                    enjoy 5% OFF discount on products at original price
                                    (Discount will be orffered if your first order is over $1000 as yoy will be considered as NEW-INSIDER.)
                                </li>
                                <li>
                                    enjoy one-time 10% OFF discount on products at original price during your birthday month
                                </li>
                                <li>
                                    If you spend more than HK$5000 in one year, the membership will be auotmatically extended for another year. Membership will expire if you spend less than $5000 within a year.
                                </li>
                            </ul>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                <div class="member-type">
                        <span>Core</span>
                    </div>
                    <div class="member-type-detail">
                        <p>
                            (3) 最高級別：JUST MEMBER
                            在365天內累積消耗超過HK$15000，您將由INSIDER成為CORE
                        </p>
                        <p>
                        会员可以随时登入账户查阅于此网站的消费记录，或直接WHATSAPP 54425298 向客服查询过往于门市及网站累积的消费金额，以进行会员升级程序。
                        </p>
                        <p>
                            您有資格：
                            <ul>
                                <li>
                                    購物以賺取和兌換積分
                                </li>
                                <li>
                                    所有原價物品可享9折優惠
                                </li>
                                <li>
                                    在您的生日月份內購買指定原價商品*可享一次性 85 折優惠*（請會員WHATSAPP 54425298 聯絡客服獲取生日優惠COUPON CODE）
                                </li>
                                <li>
                                    成為CORE後，如果您在一年內消費少於HK$8000，會員資格將自動再延長一年。 一年內消費少於$8000，會員資格會失效。
                                </li>
                            </ul>
                        </p>
                        <p>
                          Tier (3) : CORE
                          you will become a CORE from INSIDER after spending over $15000 within 1 year (365 days to be exact)
                        </p>
                        <p>
                            You are eligible to:
                            <ul>
                                <li>
                                    earn and redeem points
                                </li>
                                <li>
                                    enjoy 10% OFF discount on products at original price
                                </li>
                                <li>
                                    enjoy one-time 15% OFF discount on products at orginal price duiring your birthday month*
                                </li>
                                <li>
                                    If you spend more than HK$8000 in one year, the membership will be automatically extended for another year.
                                    Membership will expire if you spend less than $8000 within a year.
                                </li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="desc-bottom">
                <p>*Ve oola Naturals的所有產品的最高折扣為9折。</p>
                <p>*The maximum discount of all Ve Oola Naturals’ products will be 10% Off.</p>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush