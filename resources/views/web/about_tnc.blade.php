@extends('web.layout.app')
@section('content')
<section id="about-tnc" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{asset('assets/web/assets/img/about_tnc/bg.png')}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Terms & Conditions</div>
            <div class="nav-acc"><a href="#">Home</a> > <a href="#"> About</a> > <a href="#"> Terms & Conditions</a></div>
        </div>
    </div>
    <div class="tnc">
        <div class="container">
            <div class="tnc-para">
                <p class="big-title">條款與規則</p>
                <p>
                    歡迎光臨Tag Concept。 為了向您保證安全愉快的購物體驗， 我們制定了以下條款及細則， 以便更好地了解雙方的期望。 當您造訪及使用本網站時， 
                    即表示您代表您接受並遵守這些條款。 因此， 我們建議您仔細閱讀以下使用條款及細則。 若您不接受其中任何條款及細則， 請勿使用本網站。
                </p>
                <p class="title">免責聲明</p>
                <p>
                本網站及其內容按其「原貌」展示,我們僅在網站平台上提供銷售產品,不對任何直接、間接、意外、偶然、特殊、後果性或懲戒性損害及損失(包括在使用本網站的功能及服務或在本網站上購買產品而造成的任何損失,包
                括金錢利益及無形的損失)而承擔任何形式的責任。在 tag-concept.com 上購買任何產品之前,請詳細閱讀產品製造商或銷售商在產品包裝和標籤上所提供的所有信息、使用指引或警告提示。 對於所有產品的製造商或銷售
                商提供的任何信息的準確性或特定用途適用性或其質量或其可靠性,我們概不負責,使用者有全部責任去自行評估此類信息。
                </p>
                <p class="title">有關付運安排</p>
                <p class="title-v2">香港、澳門和中國內地訂單</p>
                <p>
                    由順豐速運提供送貨服務。因此,您將受順豐速運的條款和細則所約束。你必須參考他們的條款和細則,了解相關送貨服務過程的所有事項。在順豐速運運輸期間,我們不對其任何行為負責。在本聲明中,我們明確表示不
                    會承擔與任何付運失敗的風險和責任。
                </p>
                <p>
                    <ul>
                        <li>
                            <p>
                                <span class="title-v2">香港</span><br/>
                                訂單價值 HK$800 或以上:免運費
                                800港幣以下訂單:運費$30
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="title-v2">澳門</span><br/>
                                訂單價值 HK$1200 或以上:免運費*
                                1200港幣以下訂單:順豐到付*
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="title-v2">中國內地</span><br/>
                                訂單價值HK$2500或以上:免運費*
                                HK$2500以下的訂單:順豐到付*
                            </p>
                        </li>
                    </ul>
                </p>
                <p>
                    *運往香港以外的地區或國家的訂單可能需要繳納目的地國家徵收的進口稅、關稅和費用。所有額外的進口稅、關稅、清關費及運輸費用用必須由買家承擔。Tag Concept 無法控制這些費用,亦不會負責報銷任何進口稅、關
                    稅、清關費及運輸費用,全數的稅款或任何額外費用均由買家承擔。
                </p>
                <p>
                    請閱讀Shipping Info頁面了解更多詳情。
                </p>
                <p class="title-v2">
                    台灣訂單
                </p>
                <p>
                    一個訂單,跟隨一個包裹寄出。不同的訂單,不能合併為一個包裹一次寄出。
                    所有台灣訂單將以香港郵政的特快專遞服務寄出,運送時間約 1-3 個工作日。
                </p>
                <p>
                    <ul>
                        <li>
                            一個訂單,跟隨一個包裹寄出。不同的訂單,不能合併為一個包裹一次寄出。所有台灣訂單將以香港郵政的特快專遞服務寄出,運送時間約 1-3 個工作日。
                        </li>
                        <li>
                            訂單滿 HK$4000,且重量不足5公斤:免運費。如果訂單重量超過5公斤,客戶必須支付額外重量費用。我們將向你發送一封電子郵件,指導您如何支付額外費用。收到所有額外費用後,訂單才會寄出。*
                        </li>
                        <li>
                            訂單少於HK$4000 : 所有運費和可能的稅費將由買家承擔。*
                        </li>
                        <li>
                            *運往香港以外的地區或國家的訂單可能需要繳納目的地國家徵收的進口稅、關稅和費用。所有額外的進口稅、關稅、清關費及運輸費用用必須由買家承擔。Tag Concept 無法控制這些費用,亦不會負責報銷任何進口
                            稅、關稅、清關費及運輸費用,全數的稅款或任何額外費用均由買家承擔。
                        </li>
                    </ul>
                </p>
                <p class="title-v2">
                    國際訂單
                </p>
                <p>
                    一個訂單,跟隨一個包裹寄出。不同的訂單,不能合併為一個包裹一次寄出。所有國際訂單將以香港郵政的特快專遞服務寄出,運送時間約3-7 個工作日。
                </p>
                <p>
                    <ul>
                        <li>
                            國際訂單將由香港郵政運送。費用將根據訂單總重量和目的地國家計算。國際訂單和支付運費的流程已在Shipping Info頁面列出。
                        </li>
                        <li>
                            運往香港以外的地區或國家的國際訂單可能需要繳納目的地國家徵收的進口稅、關稅和費用。所有額外的進口稅、關稅、清關費及運輸費用用必須由買家承擔。Tag Concept 無法控制這些費用,亦不會負責報銷任何進口
                            稅、關稅、清關費及運輸費用,全數的稅款或任何額外費用均由買家承擔。
                        </li>
                    </ul>
                </p>
                <p>
                    Tag Concept 對任何運輸公司/代理商造成的任何運輸損失或損壞以及任何運輸延誤不承擔任何責任或義務。如果包裹出現丢失或延誤,訂單將不予退款。對於因自然災害、流行病、極端天氣條件或任何類型的意外和無法控
                    制的情況而導致的訂單丟失或損壞,我們不承擔任何責任或義務。如果發生上述情況,將不予退款。
                </p>
                <p class="title">
                    門市取貨安排
                </p>
                <p>
                    由於新冠疫情影響,門市取貨服務暫時停止,直到另行通知。
                </p>
                <p class="title">
                    退款及換貨政策
                </p>
                <p>
                    在任何情況下,我們均不接受退款。
                </p>
                <p>
                    我們銷售的所有產品都經過嚴格挑選,並儘可能確保所選產品通過了有關的皮膚測試。但是,由於各人的皮膚類型和皮膚狀況不同,我們很難保證所有人均不會引起過敏反應。如果使用從本店購買的產品後出現過敏,恕不
                    安排退款或換貨。
                </p>
                <p>
                    當你收到訂單包裹時,請馬上打開並檢查訂單中所有產品。如果您收到產品時有任何損壞,請立即聯繫我們的客戶服務人員。我們只受理在收到訂單當天起計3天內通知我們的損壞報告及換貨要求。損壞的產品也必須在收
                    到訂單後的7天內寄回給我們,如果我們無法在7天內收到產品,我們保留拒絕換貨的權利。退換的商品必須未使用、未開封且與您收到時的狀態相同。請確保退換商品包括以下內容:原包裝、包裝盒、吊牌、說明書、贈
                    品和所有其他配件等。如退換商品有任何損壞,則視為不予退換。每個訂單只允許交換一次。我們將在收到並檢查產品後立即通知您有關換貨的安排。
                </p>
                <p class="title">
                    隱私政策
                </p>
                <p>
                    我們致力於保護您的隱私,為您提供安全可靠的網絡環境。 
                    我們將盡最大努力確保您的帳戶和個人資料得到保密處理。 我們將按照本隱私政策所述的目的謹慎使用您的個人信息。
                </p>
                <p class="title-v2">
                    個人信息收集和使用
                </p>
                <p>
                    我們是本網站收集的信息的唯一所有者。 我們不會以不同於本聲明中披露的方式將這些信息出售、分享或出租給他人。 本網站只會在明確告知你的況下,收集有關您的個人識別,否則我們不會收集您的個人身份信息。 當
                    您註冊成為 Tag Concept 的會員時,您的 IP 地址、使用時間、瀏覽歷史可能會被記錄,以提高和改進我們的服務質量。
                </p>
                <p class="title-v2">
                    其他連結
                </p>
                <p>
                    本隱私聲明僅適用於本網站。 請注意,點擊本網站的鏈接,您可能會被帶到另一個網站。該網站的隱私政策可能與我們不同,因此我們強烈建議您查閱其他網站的隱私政策,我們對您提交給第三方的個人資料或由第三方收
                    集的個人資料及其用途不承擔任何責任。
                </p>
                <p class="title-v2">
                    個人資料(私隱)條例
                </p>
                <p>
                    根據香港特別行政區個人資料(私隱)條例(第486章)(「條例」)的規定,你提供給我們的資料,包括但不限稱謂、姓名、出生年月、電話號碼、電郵地址、住宅地址、信用卡資料及銀行戶口號碼等個人資料,我們在處理 您的個人資料時必須遵守該條例所載的原則。 
                    我們獲得的所有個人資料均會保存在我們的內部數據庫中,而Tag Concept 是個人資料(私隱)條例中所指的「數據控制者」。
                </p>
                <p>
                    根據《2012年個人資料(私隱)(修訂)條例》第VIA 部的規定,在直接促銷中使用客戶的個人資料必須獲得客戶的同意(或明確表示不反對) 如果您不打算接收任何有關產品和服務功能、
                    最新促銷、交易平台幫助和其他交 易資源的信息,請向我們發送電子郵件以行使您的選擇退出權。
                </p>
                <p class="title-v2">
                    隱私權政策變更通知
                </p>
                <p>
                    本網站可隨時修訂本隱私權政策,若我們對政策作出任何變更,我們將於本網站公佈。若閣下對上述隱私權聲明有任何疑問,歡迎電郵至 tagtagtagconcept@gmail.com與我們聯絡。
                    若此條款及細則的中、英文版本有歧異之處,應以英文版為準。如有任何爭議,Tag Concept保留一切最終決定權。
                </p>
            </div>
            <div class="tnc-para-eng">
                <p class="big-title">Terms and Conditions</p>
                <p>
                    Welcome to TAG Concept. In order to promise you a safe and pleasant shopping experience, we set out the following terms and conditions to achieve a better understanding of expectations of both sides. When you visit this website, it is supposed that you accept on behalf of and compliance with these terms. 
                    Therefore, we highly recommend you to carefully read the following terms of use. IF YOU DO NOT ACCEPT THESE TERMS OF USE, PLEASE DO NOT USE THIS WEBSITE.
                </p>
                <p class="title">Disclaimer</p>
                <p>
                The site and its content are provided on an "as is" basis without warranties of any kind, whether express or implied (except only as may be implied by applicable law). 
                We are only providing a venue for the sale of products on its site and shall not be liable for any direct, indirect, incidental, special, consequential or exemplary damages (including damages for loss of profit or intangible loss related to your use of the site or use of any of the products purchased at its site). Please read all information, warranties, usage or warnings provided by the manufacturer owner or seller of the products on or in the product packaging and labels before using any product purchased on tag-concept.com. We shall not be liable for the accuracy, fitness for a particular purpose or quality of such products or reliability of any information provided by any manufacturer owner or seller of such products and it is your responsibility to evaluate such information.
                </p>
                <p class="title">About Delivery</p>
                <p class="title-v2">Hong Kong, Macau and China</p>
                <p>
                    We provide delivery service hosted by SF Express for order made in Hong Kong, Macau and China. Therefore, you are bound by the terms and conditions of them. You may refer to their terms and conditions in an attempt to deal with all matters related to the process of delivery. We are not responsible to any act or misconduct while in charge of the shipping company. 
                    It is clearly said that, in this statement, we will not bear the risk and liability associated with any possible fail delivery.
                </p>
                <p>
                    <ul>
                        <li>
                            <p>
                                <span class="title-v2">Within Hong Kong</span><br/>
                                Order valued HK$800 or above: Free Shipping<br/>
                                Order valued less than HK$800: Shipping Fee $30
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="title-v2">To Macau</span><br/>
                                Order valued HK$1200 or above: Free Shipping<br/>
                                Order valued less than HK$1200: SF Express Pay On Delivery
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="title-v2">To China</span><br/>
                                Order valued HK$2500 or above: Free Shipping * <br/>
                                Order valued less than HK$2500 : SF Express Pay On Delivery*
                            </p>
                        </li>
                    </ul>
                </p>
                <p>
                    *Orders shipped to countries outside of Hong Kong may be subject to import taxes, customs duties, and fees levied by the destination country. Additional charges for customs clearance must be borne by the recipient. 
                    Tag Concept has no control over these charges and is not responsible for any reimbursement of customs fees or taxes.
                </p>
                <p>
                    Please read the page "Shipping Info" for further details.
                </p>
                <p class="title-v2">
                    Taiwan Order
                </p>
                <p>
                    One order ONLY per shipment. 
                    Combining multiple orders into one shipment is not allowed.Orders from Taiwan will be shipped via Hong Kong Post (Speed Post, 1-3 working days) now.
                </p>
                <p>
                    <ul>
                        <li>
                            Orders from Taiwan,over HK$4000 and less than 5kg: Free Shipping. Customers have to pay the extra fee if the order weighted more than 5kg. 
                            An email will be sent to instruct you how to pay the fee. Order will not be shipped unless all payments received.
                        </li>
                        <li>
                            Order from Taiwan less than HK$4000: All shipping fee and possible taxes will be shouldered by buyer.*
                        </li>
                    </ul>
                </p>
                <p>
                    *Orders shipped to countries outside of Hong Kong may be subject to import taxes, customs duties, and fees levied by the destination country. Additional charges for customs clearance must be borne by the recipient. 
                    Tag Concept has no control over these charges and is not responsible for any reimbursement of customs fees or taxes.
                </p>
                <p class="title-v2">
                    International Order
                </p>
                <p>
                    One order ONLY per shipment. Combining multiple orders into one shipment is not allowed.International order will be shipped by Hong Kong Post (Speed Post, 3-7 working days). The fee will be calculated based on the total weight of order and the destination country. 
                    The procedures for placing international order and paying shipping fee have been listed on the page "Shipping Info".
                </p>
                <p>
                    <ul>
                        <li>
                            Please be noted that any local customs issues, charges, import taxes, import duties, last-mile delivery fee, 
                            or in general any extra charge(s) regarding the shipment, will be of the receiver's sole responsibility.
                        </li>
                        <li>
                            Tag Concept shall not be liable for any discrepancies between the Shipping Fees by the shipping agent and any local fee, 
                            or additional delivery fee charged to the receiver.
                        </li>
                        <li>
                            Orders shipped to countries outside of Hong Kong may be subject to import taxes, customs duties, and fees levied by the destination country. Additional charges for customs clearance must be borne by the recipient. 
                            Tag Concept has no control over these charges and is not responsible for any reimbursement of customs fees or taxes.
                        </li>
                    </ul>
                </p>
                <p>
                    TAG Concept shall not be responsible or liable for any loss or damage of shipment and any shipment delays by any shipping companies/agencies. No refund will be issued on orders if packages are experiencing losses or delays. 
                    If orders are loss or damaged because of natural disasters, pandemic, extreme weather conditions, or any kind of unexpected situation, we will not be responsible/liable for any claims or refunds.
                </p>
                <p class="title">
                    In-store Pick Up Policy
                </p>
                <p>
                    Due to the Covid-19 pandemic situation, in-store pick up service is temporarily unavailable.
                </p>
                <p class="title">
                    Refund and Exchange
                </p>
                <p>
                    Refund is not acceptable under any circumstances.
                </p>
                <p>
                All products we sell are seriously chosen, and as far as possible to ensure the selected products have passed the required skin test. However, with the different skin types and vary skin conditions among customers, we can hardly promise you no reaction of allergy will be caused. 
                If allergy occurred after using the product bought from our shop, we are sorry that both refund or exchange will not be arranged.
                </p>
                <p>
                    Please check all the products in your order when you received your order. If there is any damage when you receive the products, please contact our customer services officers IMMEDIATELY. We only accept exchange case that is being reported WITHIN 3 DAYS after the order is received. Damaged products have to be sent back to us WITHIN 7 DAYS after the order is received as well. If we cannot receive the products within 7 days, we reserve our right to reject your exchange. Goods must be unused, unopened and in the same condition as you received it. Please include the followings: the original packaging, packaging box, tags, instructions, gifts and all other accessories etc. If any of these are damaged they are deemed to be non-returnable. 
                    Each order only allows exchange once. We will notify you the status of your exchange as soon as we received and inspected the products.
                </p>
                <p class="title">
                    Privacy Policy
                </p>
                <p>
                    We are strongly committed to protecting your privacy and providing you a safe and reliable network environment. We will do our best to ensure that your account and personal information will be kept confidential. 
                    We will carefully use your personal information according to the purpose stated in this privacy policy
                </p>
                <p class="title-v2">
                    Information Collection and Usage
                </p>
                <p>
                    We are the sole owner of the information collected on this site. We will not sell, share, or rent this information to others in ways different from what is disclosed in this statement. 
                    This web-site does not collect personally identifying information about you except when you specifically and knowingly provide it. Please be reminded that we will not collect your personal identity information unless you provide personal information in a clear informed. When you register as a member of TAG Concept, your IP address, time of use, browsing history might be recorded for the purpose of enhancing and improving our service quality.
                </p>
                <p class="title-v2">
                    Link
                </p>
                <p>
                    This Privacy Statement only applies to this website. Please note that clicking on to links and banner advertisements may result in transferal to another website, where data privacy practices may be different to us. 
                    You are strongly recommended to consult the other websites` privacy policies as we are not responsible for, and have no control over, information that is submitted to or collected by these third parties.
                </p>
                <p class="title-v2">
                    Personal Data (Privacy) Ordinance
                </p>
                <p>
                    The information given to us, including uploaded files and e-mail addresses, is termed as personal data under the Personal Data (Privacy) Ordinance (Cap. 486 of the laws of Hong Kong as amended from time to time). 
                    We must therefore follow the principles set out in that Ordinance when we process personal data. All the personal data that we obtain is held on our central in-house database and TAG Concept is the "data controller"; for the purposes of the Personal Data (Privacy) Ordinance. 
                </p>
                <p>
                In accordance with Part VIA of the Personal Data (Privacy) (Amendment) Ordinance 2012, client's consent (or any explicit indication of no objection) is required for the use of client's personal data in direct marketing. If you intend not to receive any information concerning products and services features, latest promotion, assistance on trading platform and other trading resources, you can exercise your opt-out right in writing us e-mail.
                </p>
                <p class="title-v2">
                    Changes to our Privacy Policy
                </p>
                <p>
                    This privacy policy may be changed by TAG Concept at any time. If we change our privacy policy in the future, we will set out those changes here, so that you will always know what personal information we gather, the purposes we might use it for and to whom we might disclose it. If at any time, there are questions or concerns about our online privacy statement, please feel free to e-mail us at tagtagtagconcept@gmail.com If there is any inconsistency or conflict between the English and Chinese versions of this Terms & Conditions, the English version shall prevail. 
                    In cases of disputes, the decision of Tag Concept shall be final and conclusive.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush