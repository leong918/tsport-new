@extends('web.layout.app')
@section('content')
<section id="about-shipping" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{asset('assets/web/assets/img/about_tnc/bg.png')}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Shipping Info</div>
            <div class="nav-acc"><a href="#">Home</a> > <a href="#"> About</a> > <a href="#"> Shipping Info</a></div>
        </div>
    </div>
    <div class="tnc">
        <div class="container">
            <div class="tnc-para">
                <p class="title">一般運輸安排須知</p>
                <p>
                    <ol>
                        <li>
                            <p>
                                訂單確認後,您的訂單將在2個工作日內發貨。請注意,週六、週日和公眾假期收到的訂單將在之後的2個工作日內發貨。
                            </p>
                        </li>
                        <li>
                            <p>
                                所有海外訂單均需要額外5-7個工作日才會寄出。
                            </p>
                        </li>
                        <li>
                            <p>
                                如果訂單包含一件或多件預訂的商品,我們將暫時擱置整個訂單,直到所有商品都齊貨,才會一次性將訂單寄出。
                            </p>
                        </li>
                        <li>
                            <p>
                                所有訂單將從我們在香港的倉庫或商店發貨。
                            </p>
                        </li>
                    </ol>
                </p>
                <p class="title-v2">
                    來自香港、澳門、中國內地的訂單
                </p>
                <p>
                    所有來自香港、澳門、中國內地的訂單將由順豐速運付運。訂單發貨後,您將收到一封註有郵件追蹤編號的電子郵件。
                </p>
                <p>
                    <ul>
                        <li>
                            香港境內訂單價值HK$800 或以上:免運費<br/>
                            800港幣以下訂單:運費$30
                        </li>
                        <li>
                            澳門訂單價值HK$1200或以上:免運費*<br/>
                            1200港幣以下訂單:順豐到付*
                        </li>
                        <li>
                            中國內地訂單價值HK$2500或以上:免運費*<br/>
                            HK$2500以下的訂單:順豐到付*
                        </li>
                        <li>
                            *運往香港以外的地區或國家的訂單可能需要繳納目的地國家徵收的進口稅、關稅和費用。所有額外的進口稅、關稅、清關費及運輸費用用必須由買家承擔。Tag Concept 無法控制這些費用,亦不會負責報銷任何進口 稅、關稅、清關費及運輸費用,全數的稅款或任何額外費用均由買家承擔。
                        </li>
                    </ul>
                </p>
                <p class="title-v2">
                    台灣訂單
                </p>
                <p>
                    <ul>
                        <li>
                            一個訂單,跟隨一個包裹寄出。不同的訂單,不能合併為一個包裹一次寄出。
                        </li>
                        <li>
                            所有台灣訂單將以香港郵政的特快專遞服務寄出,運送時間約1-3個工作日。
                        </li>
                        <li>
                            訂單滿 HK$4000,且重量不足5公斤:免運費。如果訂單重量超過5公斤,客戶必須支付額外重量費用。我們將向你發送一封電子郵件,指導您如何支付額外費用。收到所有額外費用後,訂單才會寄出。*
                        </li>
                        <li>
                            訂單少於 HK$4000:所有運費和可能的稅費將由買家承擔。*
                        </li>
                        <li>
                            *運往香港以外的地區或國家的訂單可能需要繳納目的地國家徵收的進口稅、關稅和費用。所有額外的進口稅、關稅、清關費及運輸費用用必須由買家承擔。Tag Concept無法控制這些費用,亦不會負責報銷任何進口 稅、關稅、清關費及運輸費用,全數的稅款或任何額外費用均由買家承擔。
                        </li>
                    </ul>
                </p>
                <p class="title">
                    國際訂單
                </p>
                <p>
                    <ul>
                        <li>
                            一個訂單,跟隨一個包裹寄出。不同的訂單,不能合併為一個包裹一次寄出。
                        </li>
                        <li>
                            所有運費和可能的稅費將由買方承擔。
                        </li>
                        <li>
                            運往香港以外的地區或國家的訂單可能需要繳納目的地國家徵收的進口稅、關稅和費用。所有額外的進口稅、關稅、清關費及運輸費用用必須由買家承擔。Tag Concept 無法控制這些費用,亦不會負責報銷任何進口稅、 關稅、清關費及運輸費用,全數的稅款或任何額外費用均由買家承擔
                        </li>
                        <li>
                            國際訂單將由香港郵政的特快專遞服務寄出,運送時間約 3-7 個工作日。國際訂單和支付運費的程序如下。1.正確填寫您的收貨地址,包括目的地國家、州、省和/或城市。2. 確定訂單時在運送方式中選擇“香港郵政: $0”。然後結帳並完成付款。3.收到您的訂單後,我們會立即準備您的訂單並計算運費。4.費用將根據訂單總重量和目的地國家計算。5.我們將發送一封電子郵件通知您運費金額。請點擊電子郵件中提供的鏈接並按照說 明支付費用。6.收到所有費用後,我們將在5-7個工作日內寄出。7. 訂單寄出後我們將向你發送一封通知電子郵件,並提供郵件追踪號碼。
                        </li>
                    </ul>
                </p>
                <p>
                    香港郵政通告:寄往某些目的地的空郵服務可能會有延誤
                </p>
                <p>
                    請按此參閱香港郵政網站的詳情。
                </p>
                <p class="title">
                    免責聲明(適用於所有訂單)
                </p>
                <p>
                    TAG Concept 對任何運輸公司/代理商造成的任何運輸損失或損壞以及任何運輸延誤不承擔任何責任或義務。如果包裹出現丟失或延誤,訂單將不予退款。對於因自然災害、流行病、極端天氣條件或任何類型的意外和無法控 制的情況而導致的訂單丟失或損壞,我們不承擔任何責任或義務。如果發生上述情況,將不予退款。
                </p>
            </div>
            <div class="tnc-para-eng">
            <p class="title">General Shippping Info</p>
                <p>
                    <ol>
                        <li>
                            <p>
                                Once order confirmed, your order will be shipped out in 2 business days. Please be reminded that orders received on Saturday, Sunday and Public Holidays will be shipped the next 2 business days.
                            </p>
                        </li>
                        <li>
                            <p>
                                For all oversea buyers, please expect 3-4 business days to ship out your international orders.
                            </p>
                        </li>
                        <li>
                            <p>
                                If you place an order that has one or more items on backorder, we will hold your entire order until all items become available. Your order will then arrive in one delivery.
                            </p>
                        </li>
                        <li>
                            <p>
                                All orders will be shipped from our warehouse or stores in Hong Kong.
                            </p>
                        </li>
                    </ol>
                </p>
                <p class="title-v2">
                    Orders from Hong Kong, Macau, China
                </p>
                <p>
                    All orders from Hong Kong, Macau, China will be shipped by SF Express. You will receive an email with tracking number as soon as your order has shipped.
                </p>
                <p>
                    <ul>
                        <li>
                            Within Hong Kong Order over HK$800: Free ShippingOrder less than HK$800: Shipping Fee $30
                        </li>
                        <li>
                            To MacauOrder over HK$1200: Free ShippingOrder less than HK$1200: SF Express Pay On Delivery
                        </li>
                        <li>
                            To ChinaOrder over HK$2500: Free Shipping *Order less than HK$2500: SF Express Pay On Delivery **Orders shipped to countries outside of Hong Kong may be subject to import taxes, customs duties, and fees levied by the destination country. Additional charges for customs clearance must be borne by the recipient. Tag Concept has no control over these charges and is not responsible for any reimbursement of customs fees or taxes.
                        </li>
                    </ul>
                </p>
                <p class="title-v2">
                    Orders from Taiwan
                </p>
                <p>
                    <ul>
                        <li>
                            One order ONLY per shipment. Combining multiple orders into one shipment is not allowed.
                        </li>
                        <li>
                            All orders from Taiwan will be shipped via Hong Kong Post (Speed Post, 1-3 working days).
                        </li>
                        <li>
                        To TaiwanOrder over HK$4000 and weighted less than 5kg: Free Shipping. Customers have to pay the extra fee if the order weighted more than 5kg. An email will be sent to instruct you how to pay the fee. Order will not be shipped unless all payments received.*Order less than HK$4000: All shipping fee and possible taxes will be shouldered by buyer.**Orders shipped to countries outside of Hong Kong may be subject to import taxes, customs duties, and fees levied by the destination country. Additional charges for customs clearance must be borne by the recipient. Tag Concept has no control over these charges and is not responsible for any reimbursement of customs fees or taxes.
                        </li>
                    </ul>
                </p>
                <p class="title">
                    International Orders
                </p>
                <p>
                    One order ONLY per shipment. Combining multiple orders into one shipment is not allowed. All shipping fee and possible taxes will be shouldered by buyer. Please be noted that any local customs issues, charges, import taxes, import duties, or in general any extra charges regarding the shipment, will be of
                    the receiver's sole responsibility. Tag Concept shall not be liable for any shipping fees requested by the shipping agent. All possible local fee, or additional delivery fee will be charged to the receiver.
                </p>
                <p>
                    International order will be shipped by Hong Kong Post (Speed Post, 3-7 working days). The procedures for placing international order and paying shipping fee are as below.
                </p>
                <p>
                    <ol>
                        <li>
                            Correctly fill in your shipping address, including destination country, state, province and/or city.
                        </li>
                        <li>
                            Place the order with all your desired products. Choose "Hong Kong Post: $0" in shipping method. Then checkout and complete payment.
                        </li>
                        <li>
                            After receiving your order, we will immediately pack your order and calculate the shipping rate.
                        </li>
                        <li>
                            The fee will be calculated based on the total weight of order and the destination country.
                        </li>
                        <li>
                        An email will be sent to inform you the amount of shipping rate. Please click the link provided in email and pay the fee as instructed.
                        </li>
                        <li>
                            We will ship out the order next business day when all fee is received.
                        </li>
                        <li>
                            A notification email will be sent when the order has shipped with tracking number provided.
                        </li>
                    </ol>
                </p>
                <p>
                    Notice from Hong Kong Post: Airmail services to certain destinations subject to delay<br/>
                    Please see the details on the website of Hong Kong Post <a href="#">here</a>.
                </p>
                <p class="title">
                    Disclaimer (Apply to all orders)
                </p>
                <p>
                TAG Concept shall not be responsible or liable for any loss or damage of shipment, and any shipment delays by any shipping companies/agencies. No refund will be issued on orders if packages are experiencing losses or delays. We shall not be responsible or liable for orders are loss or damaged because of natural disasters, pandemic, extreme weather conditions, or any kind of unexpected and uncontrollable situation. No refund will be offered if the mentioned circumstances happen.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush