
@component('mail::layout')

    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('assets/web/assets/img/global/logo.png')}}" style="width:auto" class="logo" alt="Tag Concept Logo">
        @endcomponent
    @endslot

    <div style="font-size:14px;">
        <img src="{{ $image }}" style="width:100%; object-fit:cover">
        <div style="padding:20px 0px; text-align:center; background-color:#aba470; color:white">A note has been added to your order</div>
    </div>
    <div style="margin: 20px 0px">
        <p style="font-size:14px">Hi {{ $sales_order->user->first_name }},</p>
        <p style="font-size:14px">Thank you for placing your order with us! We appreciate your business and would like to inform you about the shipping fee for your order #{{ $sales_order->sales_order_id }}.</p>
        <p style="margin-left:10px; font-size:14px;">The shipping fee for your order is HK${{ $sales_order->shipping }}. To proceed with the payment, please click on the following link: <a href="https://tag-concept.com/product/shipping-fee/">https://tag-concept.com/product/shipping-fee/</a></p>
        <p style="margin-left:10px; font-size:14px;">Once on the page, please add a quantity of {{ $sales_order->shipping }} to your shopping cart and proceed to pay the total amount of HK${{ $sales_order->shipping }}.</p>
        <p style="margin-left:10px; font-size:14px;">We aim to process and ship your order within 7-10 working days. Should there be any delays or changes in the shipping time frame, we will notify you promptly.</p>
        <p style="margin-left:10px; font-size:14px;">If you have any questions or require further assistance, please feel free to reach out to our customer service team. We are here to help.</p>
        <p style="margin-left:10px; font-size:14px;">Thank you once again for your order. We look forward to delivering your products to you soon.</p>    
        <p style="font-size:14px">As a reminder, here are your order details:</p>
    </div>
    <div>
        <h1 style="color:#aba470">[Order #{{ $sales_order->sales_order_id  }}] ({{ $date }})</h1>
        <table style="border: 1px solid black; border-collapse: collapse; width:100%; font-size:14px;">
            <tr>
                <th style="border: 1px solid black; width:40%; padding:0px 10px; text-align:left">Product</th>
                <th style="border: 1px solid black; width:10%; padding:0px 10px; text-align:left">Quantity</th>
                <th style="border: 1px solid black; width:50%; padding:0px 10px; text-align:left">Price</th>
            </tr>
            @foreach($sales_order->salesOrderProduct as $sales_order_product)
            <tr>
                <td style="border: 1px solid black; padding:0px 10px">{{ $sales_order_product->product_name }}</td>
                <td style="border: 1px solid black; padding:0px 10px">{{ $sales_order_product->quantity }}</td>
                <td style="border: 1px solid black; padding:0px 10px">${{ $sales_order_product->total_price }}</td>
            </tr>
            @endforeach
            <tr>
                <td style="border: 1px solid black; padding:0px 10px" colspan="2"><b>Subtotal:</b></td>
                <td style="border: 1px solid black; padding:0px 10px">${{ $sales_order->subtotal }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding:0px 10px" colspan="2"><b>Discount:</b></td>
                <td style="border: 1px solid black; padding:0px 10px">-${{ $sales_order->discount }}</td>
            </tr>
            <tr style="border-top:5px solid black;">
                <td style="border: 1px solid black; padding:0px 10px" colspan="2"><b>Shipping:</b></td>
                <td style="border: 1px solid black; padding:0px 10px">[Free shipping免運費 | 如寄往順豐站/智能櫃，直接輸入點碼即可 ] 如果訂單包含預訂商品，我們將暫時擱置整個訂單，直到所有商品都齊貨才會將訂單寄出。 如客人要求先寄出現貨，滿$800的訂單我們只會負責第一次寄貨的費用，第二次及隨後寄貨的費用一律到付由買家負責。</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding:0px 10px" colspan="2"><b>Payment method:</b></td>
                <td style="border: 1px solid black; padding:0px 10px">{{ $sales_order->payment_method }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding:0px 10px" colspan="2"><b>Total:</b></td>
                <td style="border: 1px solid black; padding:0px 10px">${{ $sales_order->total }}</td>
            </tr>
        </table>
    </div>
    <div style="margin:20px 0px;">
        <table style="width:50%; font-size:14px;">
            <tr>
                <th style="text-align:left;"><h1 style="color:#aba470">Shipping Address</h1></th>
            </tr>
            <tr>
                <td>{{ $sales_order->last_name . " " . $sales_order->first_name  }}</td>
            </tr>
            <tr>
                <td>{{ $sales_order->address }}</td>
            </tr>
            <tr>
                <td>{{ $sales_order->postcode . ", " . $sales_order->city }}</td>
            </tr>
            <tr>
                <td>{{ $sales_order->state . ", " . $sales_order->country }}</td>
            </tr>
            <tr>
                <td><a href="https://wa.me/"{{ $sales_order->phone_no }} style="color:#aba470">{{ $sales_order->phone_no }}</a></td>
            </tr>
            <tr>
                <td><a href="mailto:"{{ $sales_order->email }} style="color:#aba470">{{ $sales_order->email }}</a></td>
            </tr>
        </table>
    </div>
    <p style="font-size:14px">Thanks for reading.</p>

    @slot('footer')
        @component('mail::footer')
        <div style="background-color:black; margin:-32px !important; padding: 15px 0px;">
            <div style="text-align: center; font-size:10px; color:white; margin:15px 0px">
                Tag Concept 
            </div>
            <div style="display:flex; justify-content: center; ">
                <a href="https://www.facebook.com/tagconcept" style="padding:5px; font-size:13px; border-radius:10px;">
                    <img src="{{asset('assets/web/assets/img/global/fb.png')}}" style="width:30px; height:30px; border-radius:30px; object-fit:cover" class="logo" alt="Facebook Logo">
                </a>
                <a href="https://www.instagram.com/tagconcept" style="padding:5px; font-size:13px; border-radius:10px;">
                    <img src="{{asset('assets/web/assets/img/global/ig.png')}}" style="width:30px; height:30px; border-radius:30px; object-fit:cover" class="logo" alt="Instagram Logo">
                </a>
            </div>
        </div>
        @endcomponent
    @endslot
    
@endcomponent