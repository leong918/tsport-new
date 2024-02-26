@extends('web.layout.app')
@section('content')
<div id="product_details" class="margin-header">
    <div class="container details-wrapper">
        <div class="row">
            <div class="col-12 row nav-wrapper">
                <div class="d-flex nav-title-wrapper">
                    <div>Home</div>
                    <div>></div>
                    <div>Skincare</div>
                    <div>></div>
                    <div>Cleanser</div>
                </div>
            </div>
            <div class="col-12 col-lg-6 row justify-content-between image-wrapper">
                <div class="col-12 col-lg-2 image-viewer-slider slider-nav align-items-center p-0">
                    <div class="d-flex flex-column justify-content-center align-center"><img src="{{asset('assets/web/assets/img/product_details/product_1.png')}}"></div>
                    <div class="d-flex flex-column justify-content-center align-center"><img src="{{asset('assets/web/assets/img/product_details/product_2.png')}}"></div>
                    <div class="d-flex flex-column justify-content-center align-center"><img src="{{asset('assets/web/assets/img/product_details/product_3.png')}}"></div>
                    <div class="d-flex flex-column justify-content-center align-center"><img src="{{asset('assets/web/assets/img/product_details/product_1.png')}}"></div>
                    <div class="d-flex flex-column justify-content-center align-center"><img src="{{asset('assets/web/assets/img/product_details/product_2.png')}}"></div>
                </div>
                <div class="col-12 col-lg-10 image-viewer slider-for">
                    <div><img src="{{asset('assets/web/assets/img/product_details/product_1.png')}}"></div>
                    <div><img src="{{asset('assets/web/assets/img/product_details/product_2.png')}}"></div>
                    <div><img src="{{asset('assets/web/assets/img/product_details/product_3.png')}}"></div>
                    <div><img src="{{asset('assets/web/assets/img/product_details/product_1.png')}}"></div>
                    <div><img src="{{asset('assets/web/assets/img/product_details/product_2.png')}}"></div>
                </div>
            </div>
            <div class="col-12 col-lg-6 product-wrapper">
                <div class="row">
                    @if(function_exists('reviewRenderView'))
                    {{ reviewRenderView('product_detail_top_review') }}
                    @endif
                    <div class="col-9">
                        <div class="">
                            <div class="col-10 product-title"><span class="ch-m">[增量升級版］</span>Lovinah Dragon's Blood BHA Cleansing Oil <span class="ch-m">龍血樹温和雙膠囊水楊酸卸妝潔面油100ml</span></div>
                        </div>
                    </div>
                    <div class="col-2 d-flex justify-content-end wishlist-wrapper">
                        <img src="{{asset('assets/web/assets/img/product_details/wishlist_icon.png')}}">
                    </div>
                </div>
                <div class="d-flex justify-content-between product-action-wrapper">
                    <div class="product-price d-flex flex-column justify-content-center">
                        $530
                    </div>
                    <div class="d-flex justify-content-between product-quantity-wrapper">
                        <div><button class="action-button minus"><img src="{{asset('assets/web/assets/img/product_details/minus.png')}}" /></button></div>
                        <div><input type="text" value="1" class="quantity-text" readonly /></div>
                        <div><button class="action-button plus"><img src="{{asset('assets/web/assets/img/product_details/plus.png')}}" /></button></div>
                    </div>
                </div>
                <div class="row action-button-wrapper">
                    <div class="col-12 col-lg-6 ps-0"><button class="cart-button">ADD TO CART</button></div>
                    <div class="col-12 col-lg-6 pe-0"><button class="buy-button">BUY IT NOW</button></div>
                </div>

                <div class="row">
                    <div class="col-12 product-details-wrapper mx-auto">
                        <ul class="product-details-list">
                            <li>增量升級版由50ml倍增至100ml，成份不變，採用全新製作技術，形成gel-To-0il般更濃稠的質地。</li>
                            <li>累積熱資近5000支！！被客人稱為「拟西油」，將千年暗粒逐一原粒推出洗走，誓要將所有換到但睇唔到又唧唔到嘅粒粒驅逐出去！</li>
                            <li>適用於所有皮膚類型，特別針對毛孔堵塞，受封閉性粉刺，暗繪暗粒等問題困授的皮膚</li>
                            <li>蘊含龍血樹液，維他命C和經雙膠囊包覆水楊酸的卸妝油，注入高濃缩的維他命和營養豐高的成份，令卸妝也是一個豪華的體驗。</li>
                            <li>御妝油與水一起乳化，絕不留下油膩殘留物，能徹底清除沉重的化妝品，多餘的油脂污垢和其他堵塞毛孔的雜質。</li>
                            <li>深層滋潤皮膚，亦不會傷害皮灣屏障和天然皮脂，為最敏感的皮灣而設計。</li>
                            <li>可温和地輕度去除角質，並幫助防止黑頭和死皮細胞的積聚，有助於軟化角質，去除毛孔的雜質，對抗空氣污染物，使皮膚感回復潔淨，平滑，水潤，並重新注入豐高營養。</li>
                        </ul>
                        <hr />
                        <div class="faq-title">FAQ. Dragon Blood BHA Cleansing Oil （類西油）和 Ocean Rituals Cleansing Balm 有什麽分別？</div>
                        <ol class="product-faq-list">
                            <li>Dragon Blood BHA Cleansing Oil 含有2%雙膠粪包覆水陽酸，適合去除一般程度黑頭粉問題。特別適合以下情況使用：進入卵期/工作繁 /壓力大/飲食習慣不健康，導致油脂分泌鞍旺盛，粉刺暗粒變多。</li>
                            <li>Ocean Rituals Cleansing Balm 特別針對潮濕天氣及暗瘡肌使用，含有天然BHA,AHA溶解黑頭及代謝暗問題較佳，同時不會損害皮膚天然皮脂</li>
                        </ol>
                        <hr />
                        <ul>
                            <li>請查石產品圖片3：產品不同批次之間會出現顏色上的差別，此乃天然植物萃取的特性，為正常現象，敬誚留意</li>
                        </ul>
                    </div>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 product-info-wrapper">
        <div class="col-12 col-md-10 col-lg-7">
            <ul class="nav nav-tabs info-action-button" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desciption" type="button" role="tab" aria-controls="desciption" aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ingredients" type="button" role="tab" aria-controls="ingredients" aria-selected="false">Ingredients</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#usage" type="button" role="tab" aria-controls="usage" aria-selected="false">Usage</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="false">Additional Information</button>
                </li>
                @if(function_exists('reviewRenderView'))
                {{ reviewRenderView('product_detail_nav_title') }}
                @endif
            </ul>
            <div class="tab-content description" id="myTabContent">
                <div class="tab-pane fade show active" id="desciption" role="tabpanel" aria-labelledby="desciption-tab">
                    <div class="content-wrapper">
                        <div class="list-title ch-m">主要功效</div>
                        <ul class="ch-l">
                            <li>經雙膠囊包覆的水楊酸和滋養皮膚的植物油</li>
                            <li>徹底清除沉重的化妝品 多餘油脂污垢 和其他堵塞毛孔的雜質</li>
                            <li>温和輕度去除角質 防止黑頭和死皮細胞的積聚</li>
                            <li>有助於對抗頑固暗瘡 使皮膚更透亮柔軟</li>
                        </ul>
                    </div>

                    <div class="content-wrapper">
                        <div class="list-title ch-m">適合膚賞</div>
                        <ul class="ch-l">
                            <li>適用於所有皮膚類型</li>
                            <li>毛孔堵塞，受封閉性粉刺問題困擾的人士</li>
                        </ul>
                    </div>

                    <div class="content-wrapper">
                        <div class="list-title ch-m">主要成分</div>
                        <ul class="ch-l">
                            <li>2%雙膠戰包覆水楊酸：採用經雙膠報包覆技術處理的水楊酸，基於水楊酸的雙重封裝，當內外雙層包覆的膠箋遇水 磨擦而破裂時，水楊酸會慢慢地釋放到皮膚上，可使水楊酸在皮膚上保留數小時，具有更好的去除油脂功效和抗粉刺能力，而不具刺激性。</li>
                            <li>高穩定性，脂溶性的維他命C酯（四己基抗壞血酸）：一種極高穩定的脂溶性的維他命C酯，具有活性抗氧化劑，能抑 制脂質氧化。局部使用可以減輕紫外線照射的破壞作用。與一般抗壞血酸維他命C不同，它不會削弱或刺激皮膚。</li>
                            <li>番石榴籽油：強大的抗氧化劑，可幫助抵抗自由基並保持皮膚彈性，以防止皮膚發紅，預防過早衰老和皺紋。這是一種具收斂油脂和非致粉刺特性的油脂，可以對付顽固痤瘡和減少痤瘡疤痕。番石 榴種子植物油對皮膚有再生作用皮膚，它包含強效的抗氧化劑番茄紅素，可消除自由基，抗老化。番石榴籽油還富含天然菸酸，維他命A，B，C，E和其他植物營養素，幫助皮膚 保持水分，延級衰老，改善膚色並收緊皮膚。</li>
                            <li>營莓籽油：尝莓籽油富含為維他命C、類胡蘿蔔素、維他命E、亞油酸、A-亞麻酸、油酸，可幫助肌膚 抵禦紫外線傷害，具有卓越清除自由基的功能，同時舒緩可肌膚，是去除面色的暗沉和黃 氣、提亮膚色的聖品。愛察籽油可以刺激膠原蛋白的產生，能夠幫助延緩和抵抗細紋，皺紋 和其他衰老的跡象。</li>
                            <li>越橘籽油：越橘具有極高的抗氧化劑，植物固醇和必需的0mega-3和0mega-6脂肪酸，越橘籽油中含 有y-生育三烯酚，一種天然維他命E，比人造維他命E強大60倍，助於滋潤皮膚，具有抗皺效果，保持皮膚水分和彈性。越橘籽油的有高含量的a-亞麻酸，與亞油酸一起佔總脂肪酸 的85%，能滋潤和撫平皮膚，使皮膚保持年輕，充滿活力。</li>
                            <li>番茄籽油，野櫻莓籽油，木鱉果油，番茄紅素果實提取物：抗氧，去除暗沉黃氣，提亮膚色，消除自由基，兼具豐富脂肪酸滋養皮膚。</li>
                            <li>乳薊草籽油：強大的抗氧化劑，可以幫助保護皮膚免受自由基 和周圍環境的污染，防止UVA和UVB紫外線輻射引起的皮膚損害，避免導致肌膚過早老化。</li>
                            <li>白雞蔔籽油，海甘藍籽油：滋養修復，質感輕薄。</li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade" id="ingredients" role="tabpanel" aria-labelledby="ingredients-tab">
                    <div class="content-wrapper">
                        <ul style="list-style: none;" class="p-0">
                            <li>Silybum Marianum (Milk Thistle) Seed Oil,</li>
                            <li>Raphanus Sativus (Radish) Seed Oil,</li>
                            <li>Crambe Abyssinica,</li>
                            <li>Solanum Lycopersicum (Tomato) Seed Oil,</li>
                            <li>Psidium Guajava Seed Oil,</li>
                            <li>Cloudberry (Rubus Chamaemorus),</li>
                            <li>Vaccinium Vitis-Idaea (Lingonberry) Seed Oil,</li>
                            <li>Chokeberry (Aronia Melanocarpa) Seed Oil,</li>
                            <li>Momordica Cochinchinensis (Gac Seed) Oil,</li>
                            <li>Croton Lechleri Resin Extract,</li>
                            <li>Tetrahexyldecy|Ascorbate,</li>
                            <li>Polyglycery1-3Palmitate Polyglyceryl-4 Oleate,</li>
                            <li>Polyglycery1-5 Oleate,</li>
                            <li>Salicylic Acid,</li>
                            <li>Lithospermum Erythrorhizon,</li>
                            <li>Solanum Lycopersicum (Lycopene) Fruit Extract,</li>
                            <li>Tocopherol (Vitamin E)</li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade" id="usage" role="tabpanel" aria-labelledby="usage-tab">
                    <ol class="content-wrapper ch">
                        <li>如沒有化妝只有使用防睡：取5-6泵份量的cleansing Oil，乾手乾面打圈按摩全嬐連頸約一分鐘後，先讓oil停留臉上敷2分鐘，然後才再加水乳化打圈按摩約一分鐘，最後用洁水洁洗所有殘餘物。</li>
                        <li>有化妝及使用防囉：取5-6泵份量的cleansing Oil，乾手乾面打圈按摩全嬐連頸約一至兩分鐘以溶解妝容、油脂及黑頭。再加水乳化打圈按摩約一分鐘，最後用清水清洗所有殘餘物。</li>
                    </ol>
                    <div class="content-wrapper ch">產品開封後請於12個月內完成使用。</div>
                    <div class="content-wrapper">Pump The Product Once More And Thoroughly Massage Problem Areas Around The Nose, Forehead, And Cheeks. Wet Your Hands With Lukewarm Water And Massage For Thirty Seconds More. Rinse Thoroughly With Lukewarm Water.</div>
                    <div class="content-wrapper">This Product Is Useable For 12 Months Once Opened.</div>
                </div>
                <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="content-wrapper d-flex justify-space-between">
                        <div class="col-3">Brands</div>
                        <div class="col-9">LOVINAH</div>
                    </div>
                    <div class="content-wrapper d-flex justify-space-between">
                        <div class="col-3">Pregnant Friendly</div>
                        <div class="col-9">Using Salicylic Acid In No Higher Than A 2% Concentration Once Or Twice A Day During Pregnancy Is Generally Considered As Safe, We Do However Recommend Pregnant Women Consult A Physician Prior To Use Of Salicylic Acid Product.</div>
                    </div>
                </div>
                @if(function_exists('reviewRenderView'))
                {{ reviewRenderView('product_detail_nav_content') }}
                @endif
            </div>
        </div>
    </div>
    <div class="continue-shopping-product">
        <div class="">
            <div class="title-new">Related Products</div>
        </div>
        <div class="swiper mySwiper-continueproduct">
            <div class="swiper-wrapper">
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-1.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-1-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            @if(function_exists('reviewRenderView'))
                            {{ reviewRenderView('common_star_rating') }}
                            @endif
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-2.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-2-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            @if(function_exists('reviewRenderView'))
                            {{ reviewRenderView('common_star_rating') }}
                            @endif
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-3.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-3-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            @if(function_exists('reviewRenderView'))
                            {{ reviewRenderView('common_star_rating') }}
                            @endif
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-4.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-4-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            @if(function_exists('reviewRenderView'))
                            {{ reviewRenderView('common_star_rating') }}
                            @endif
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-5.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-5-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            @if(function_exists('reviewRenderView'))
                            {{ reviewRenderView('common_star_rating') }}
                            @endif
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-1.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-1-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            @if(function_exists('reviewRenderView'))
                            {{ reviewRenderView('common_star_rating') }}
                            @endif
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-2.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-2-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            @if(function_exists('reviewRenderView'))
                            {{ reviewRenderView('common_star_rating') }}
                            @endif
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-3.png')}}">
                    <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-3-hover.png')}}">
                    <div class="wishlist-cart-container">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <!-- wishlist -->
                                <div class="wishlist-container">
                                    <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                    <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--cart-->
                                <div class="cart-container">
                                    <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                    <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            @if(function_exists('reviewRenderView'))
                            {{ reviewRenderView('common_star_rating') }}
                            @endif
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
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
    //new-product
    var swiper = new Swiper(".mySwiper-continueproduct", {
        autoplay: {
            delay: 3000,
        },

        breakpoints: {
            375: {
                slidesPerView: 1.75,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
        }
    });

    $(document).ready(function() {
        var selectReviewStar = 0;

        $('body').on('click', '.review-star-control', function() {
            var selectedStar = $(this).data("number");
            selectReviewStar = selectedStar;
            $('.review-star-control').each(function(){
                if($(this).data("number") <= selectedStar){
                    $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_1.png')}}");
                }else{
                    $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_2.png')}}");
                }
            });
        }),

        $('.leave-review-wrapper .star-wrapper').hover(
            function() {
                $('.review-star-control').hover(
                    function() {
                        var selectedStar = $(this).data("number");
                        $('.review-star-control').each(function(){
                            if($(this).data("number") <= selectedStar){
                                $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_1.png')}}");
                            }
                        });
                        
                    },
                    function() {
                        $('.review-star-control').each(function(){
                            $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_2.png')}}");
                        })
                    },
                )
            } , 
            function(){
                $('.review-star-control').each(function(){
                    if($(this).data("number") <= selectReviewStar){
                        $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_1.png')}}");
                    }else{
                        $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_2.png')}}");
                    }
                });
            }
        );

        $('body').on('click', '.minus', function() {
            var input_quantity = $(this).parent().parent().find('.quantity-text');
            input_quantity.val(parseInt(input_quantity.val()) - 1);
        });

        $('body').on('click', '.plus', function() {
            var input_quantity = $(this).parent().parent().find('.quantity-text');
            input_quantity.val(parseInt(input_quantity.val()) + 1);
        });

        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            infinite: false,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 3.99,
            infinite: false,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            focusOnSelect: true,
            prevArrow: '',
            nextArrow: '',
            rows: 0,
            vertical: true,
            verticalSwiping: true,
            responsive: [{
                breakpoint: 991,
                settings: {
                    vertical: false,
                    verticalSwiping: false,
                    prevArrow: '',
                    nextArrow: '',
                },
            }],
        });
    });
</script>
@endpush