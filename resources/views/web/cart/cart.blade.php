@extends('web.layout.app')
@section('content')
<div id="shopping_cart" class="overflow-x-hidden margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="shopping-cart-wrapper">
                <div class="shopping-cart-title">Shopping Cart</div>
                <div class="row justify-content-center shopping-cart-content">
                    <div class="col-md-12 col-lg-8 shopping-cart-content">
                        <div class="shopping-cart-banner">
                            <div><img src="{{asset('assets/web/assets/img/shopping_cart/shopping_cart_banner_2.png')}}" /></div>
                            <div><button class="add-to-cart d-none d-lg-block">ADD TO CART</button></div>
                        </div>
                        <div><button class="add-to-cart d-block d-lg-none">ADD TO CART</button></div>
                        <table class="cart-item-list d-none d-md-block">
                            <tr>
                                <th style="width:50%">Product</th>
                                <th style="width:14%">Price</th>
                                <th style="width:17%">Quantity</th>
                                <th style="width:14%">Total</th>
                                <th style="width:5%"></th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <img src="{{asset('assets/web/assets/img/shopping_cart/product_1.png')}}">
                                        <div class="product-desc">【全新升級配方】LOVINAH DRAGON'S BLOOD
                                            BRIGHTENING+HYDARTING FACE TONIC
                                            龍血樹抗氧亮肌爽膚水100ML
                                        </div>
                                    </div>
                                </td>
                                <td class="unit-price">$490</td>
                                <td>
                                    <div class="d-flex justify-content-between quantity-wrapper">
                                        <button class="action-button minus"><img src="{{asset('assets/web/assets/img/shopping_cart/minus.png')}}" /></button>
                                        <input type="text" value="1" class="quantity-text" readonly/>
                                        <button class="action-button plus"><img src="{{asset('assets/web/assets/img/shopping_cart/plus.png')}}" /></button>
                                    </div>
                                </td>
                                <td class="total-price">$490</td>
                                <td><button class="remove-button"><img src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}" /></button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <img src="{{asset('assets/web/assets/img/shopping_cart/product_2.png')}}">
                                        <div class="product-desc">【全新升級配方】LOVINAH DRAGON'S BLOOD
                                            BRIGHTENING+HYDARTING FACE TONIC
                                            龍血樹抗氧亮肌爽膚水100ML
                                        </div>
                                    </div>
                                </td>
                                <td class="unit-price">$490</td>
                                <td>
                                    <div class="d-flex justify-content-between quantity-wrapper">
                                        <button class="action-button minus"><img src="{{asset('assets/web/assets/img/shopping_cart/minus.png')}}" /></button>
                                        <input type="text" value="1" class="quantity-text" readonly/>
                                        <button class="action-button plus"><img src="{{asset('assets/web/assets/img/shopping_cart/plus.png')}}" /></button>
                                    </div>
                                </td>
                                <td class="total-price">$490</td>
                                <td><button class="remove-button"><img src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}" /></button></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div class="giveaway-desc">
                                        Giveaway
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <img src="{{asset('assets/web/assets/img/shopping_cart/product_2.png')}}">
                                        <div class="product-desc">【全新升級配方】LOVINAH DRAGON'S BLOOD
                                            BRIGHTENING+HYDARTING FACE TONIC
                                            龍血樹抗氧亮肌爽膚水100ML
                                        </div>
                                    </div>
                                </td>
                                <td class="unit-price">$490</td>
                                <td>
                                    <div class="quantity-wrapper">
                                        <input type="text" value="1" class="quantity-text" readonly/>
                                    </div>
                                </td>
                                <td class="total-price">$0</td>
                                <td></td>
                            </tr>
                        </table>
                        <div class="mobile-cart-item-list d-block d-md-none">
                            <div class="cart-item-wrapper">
                                <div class="d-flex">
                                    <img src="{{asset('assets/web/assets//img/shopping_cart/product_1.png')}}">
                                    <div class="cart-item-details d-flex flex-column justify-content-between items-center">
                                        <div class="d-flex justify-content-between">
                                            <div class="product-desc">
                                                【全新升級配方】LOVINAH DRAGON'S BLOOD
                                                BRIGHTENING+HYDARTING FACE TONIC
                                                龍血樹抗氧亮肌爽膚水100ML
                                            </div>
                                            <div>
                                                <button class="remove-button"><img src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}" /></button>
                                            </div>
                                        </div>

                                        <div class="product-price d-flex">
                                            <div class="label">Price:</div>
                                            <div class="data">$490</div>
                                        </div>
                                        <div class="product-price-wrapper d-flex justify-content-between">
                                            <div class="d-flex quantity-wrapper">
                                                <button class="action-button minus"><img src="{{asset('assets/web/assets//img/shopping_cart/minus.png')}}" /></button>
                                                <input type="text" value="1" class="quantity-text" readonly/>
                                                <button class="action-button plus"><img src="{{asset('assets/web/assets//img/shopping_cart/plus.png')}}" /></button>
                                            </div>
                                            <div class="d-flex total-wrapper">
                                                <div class="label">Total:</div>
                                                <div class="data">$490</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="cart-item-wrapper">
                                <div class="d-flex">
                                    <img src="{{asset('assets/web/assets//img/shopping_cart/product_2.png')}}">
                                    <div class="cart-item-details d-flex flex-column justify-content-between items-center">
                                        <div class="d-flex justify-content-between">
                                            <div class="product-desc">
                                                【全新升級配方】LOVINAH DRAGON'S BLOOD
                                                BRIGHTENING+HYDARTING FACE TONIC
                                                龍血樹抗氧亮肌爽膚水100ML
                                            </div>
                                            <div>
                                                    <button class="remove-button"><img src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}" /></button>
                                            </div>
                                        </div>
                                        <div class="product-price d-flex">
                                            <div class="label">Price:</div>
                                            <div class="data">$490</div>
                                        </div>
                                        <div class="product-price-wrapper d-flex justify-content-between">
                                            <div class="d-flex quantity-wrapper">
                                                <button class="action-button minus"><img src="{{asset('assets/web/assets//img/shopping_cart/minus.png')}}" /></button>
                                                <input type="text" value="1" class="quantity-text" readonly/>
                                                <button class="action-button plus"><img src="{{asset('assets/web/assets//img/shopping_cart/plus.png')}}" /></button>
                                            </div>
                                            <div class="d-flex total-wrapper">
                                                <div class="label">Total:</div>
                                                <div class="data">$490</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="giveaway-desc">
                                Giveaway
                            </div>
                            <div class="cart-item-wrapper">
                                <div class="d-flex">
                                    <img src="{{asset('assets/web/assets//img/shopping_cart/product_2.png')}}">
                                    <div class="cart-item-details d-flex flex-column justify-content-between items-center">
                                        <div class="product-desc">
                                            【全新升級配方】LOVINAH DRAGON'S BLOOD
                                            BRIGHTENING+HYDARTING FACE TONIC
                                            龍血樹抗氧亮肌爽膚水100ML
                                        </div>
                                        <div class="product-price d-flex">
                                            <div class="label">Price:</div>
                                            <div class="data">$490</div>
                                        </div>
                                        <div class="product-price-wrapper d-flex justify-content-between">
                                            <div class="d-flex quantity-wrapper">
                                                <div class="label">Quantity:</div>
                                                <input type="text" value="1" class="quantity-text" readonly/>
                                            </div>
                                            <div class="d-flex total-wrapper">
                                                <div class="label">Total:</div>
                                                <div class="data">$490</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="margin: 20px 0"/>
                        <div class="d-flex coupon-wrapper">
                            <input type="text" class="coupon-text" placeholder="Coupon"/>
                            <button class="coupon-button">APPLY COUPON</button>
                        </div>
                    </div>
                    <div class="mt-5 mt-lg-0 col-md-12 col-lg-4">
                        <div class="shopping-cart-summary">
                            <div class="cart-title">Cart Totals</div>
                            <div class="subtotal">
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="label">Subtotal</div>
                                    <div class="data-label">
                                        <div class="price">$980</div>
                                    </div>
                                </div>
                            </div>
                            <div class="discount">
                                <div class="label">Discount</div>
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="inner-label">member discount</div>
                                    <div class="data-label">
                                    <div class="price">-$49</div>
                                </div>
                                </div>
                            </div>
                            <div class="coupon">
                                <div class="label">Coupon</div>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-between data-content-wrapper">
                                        <div class="inner-label">IOTH-JM-VO-D12</div>
                                        <div class="data-label">
                                            <div class="price">-$98</div>
                                        </div>
                                    </div>
                                    <div class="btn-remove-wrapper"><button class="remove-button">remove</button></div>
                                </div>
                            </div>
                            <div class="point-redemption">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-between data-content-wrapper">
                                        <div class="label">Point redemption</div>
                                        <div class="data-label">
                                            <div class="price">-$10</div>
                                        </div>
                                    </div>
                                    <div class="btn-remove-wrapper"><button class="remove-button">remove</button></div>
                                </div>
                            </div>
                            <hr/>
                            <div class="total">
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="label">Total</div>
                                        <div class="data-label">
                                        <div class="price">$853</div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout">
                                <!-- <button id="checkoutBtn" >CHECKOUT</button> -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                                       CHECKOUT
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- <div class="login-modal" tabindex="-1">
                <div>
                    <button class="close-btn" id="close-btn"><img src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}" /></button>
                </div>
                <div class="desc-wrapper">
                    <div class="d-flex justify-content-center text-center cn-desc-wrapper">
                        <div class="cn-desc">請先登入或註冊您的帳戶 ,<br/>以便順利完成交易。謝謝 !</div>
                    </div>
                    <div class="d-flex justify-content-center text-center en-desc-wrapper">
                        <div class="en-desc">Please log in or create your account to proceed with the transaction smoothh; Thank you!</div>
                    </div>
                </div>
                <div>
                    <button class="login-button">LOGIN</button>
                </div>
                <div class="my-3 text-center">or</div>
                <div>
                    <button class="register-button">CREATE ACCOUNT</button>
                </div>
            </div> -->


                <!-- Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1> -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="desc-wrapper">
                            <div class="d-flex justify-content-center text-center cn-desc-wrapper">
                                <div class="cn-desc">請先登入或註冊您的帳戶 ,<br/>以便順利完成交易。謝謝 !</div>
                            </div>
                            <div class="d-flex justify-content-center text-center en-desc-wrapper">
                                <div class="en-desc">Please log in or create your account to proceed with the transaction smoothh; Thank you!</div>
                            </div>
                        </div>
                        <div>
                            <button class="login-button">LOGIN</button>
                        </div>
                        <div class="my-3 text-center">or</div>
                        <div>
                            <button class="register-button">CREATE ACCOUNT</button>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> -->
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
$(document).ready(function() {
    $('body').on('click', '.minus', function() {
        var input_quantity = $(this).parent().find('.quantity-text');
        input_quantity.val(parseInt(input_quantity.val()) - 1);
    });

    $('body').on('click', '.plus', function() {
        var input_quantity = $(this).parent().find('.quantity-text');
        input_quantity.val(parseInt(input_quantity.val()) + 1);
    });

    // $('body').on('click', '#checkoutBtn', function() {
    //     $(this).parents().find(".login-modal").removeClass('hide-modal').addClass('show-modal');
    // });

    // $('body').on('click', '#close-btn', function() {
    //     $(this).parents('.login-modal').removeClass('show-modal').addClass('hide-modal');
    // });

    // Update modal position on window resize
//     $(window).resize(function(){
//         clearTimeout(resizeTimeout);
//         resizeTimeout = setTimeout(function () {
//             positionModal();
//         }, 250); // Adjust the debounce delay as needed
//   });

    // Function to position the modal
    // function positionModal() {
    //     var modal = $(".login-modal");
    //     var windowWidth = $(window).width();
    //     var windowHeight = $(window).height();

    //     console.log(windowWidth, windowHeight);
    //     // Calculate new position
    //     var left = Math.max((windowWidth - modal.outerWidth()) / 2, 0);
    //     var top = Math.max((windowHeight - modal.outerHeight()) / 2, 0);

    //     // Set new position
    //     modal.css({
    //         left: left + "px",
    //         top: top + "px",
    //     });

    //         // Check if the window width is below a certain threshold (e.g., 768px for mobile)
    //     var mobileThreshold = 768;

    //     if (windowWidth < mobileThreshold) {
    //         // Set the modal to full width on mobile
    //         modal.css({
    //             transform: "translate(0, -50%)" + "!important", // Adjust the transformation as needed
    //         });
    //     } else {
    //         // Reset the width and left position for larger screens
    //         modal.css({
    //             transform: "translate(-50%, -50%) !important",
    //         });
    //     }
    // }
});
</script>
@endpush