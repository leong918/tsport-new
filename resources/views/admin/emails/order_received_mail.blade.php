
<x-mail::message>
<div>
    <img src="{{ $image }}">
    <div style="padding:20px 0px; text-align:center; background-color:#aba470; color:white">Thank you for your order</div>
</div>
<div style="margin: 20px 0px">
    <p>Hi {{ $sales_order->user->first_name }},</p>
    <p>Thanks for your order. It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:</p>
    <p>Please WhatsApp +852-54425298 with your Order ID once the payment has been completed.<br/>
        *Please ensure that payment is made within 12 hours after placing the order, otherwise your order will be automatically cancelled.<br/>
        *An additional administrative fee of HK$30 will be charged if the payment slip or completed payment screenshot is missing.<br/>
        Your order will only be shipped once the fee is received.
    </p>
    <div>
        <p><h1>Our bank details</h1></p>
        <div style="margin-bottom:20px">
            <p><h2>Great Fancy Ltd</h2></p>
            <ul>
                <li>Bank: <b>Hang Seng Bank</b></li>
                <li>Account number: <b>788-001865-883</b></li>
            </ul>
        </div>
        <div style="margin-bottom:20px">
            <p><h2>Great Fancy Ltd</h2></p>
            <ul>
                <li>Bank: <b>Alipay HK</b></li>
                <li>Account number: <b>Please find our Alipay HK QR code in the Page “消費券 Consumption Voucher” in our main menu. 由於AlipayHK對每一次收款所設定的上限為HK$5000，如客人的訂單金額超過HK$5000而選擇使用AlipayHK付款，請先付$5000，然後再付餘額。如有疑問，請whatsapp 54425298查詢。</b></li>
            </ul>
        </div>
    </div>
</div>
<div>
    <h1>[Order #{{ $sales_order->sales_order_id  }}] ({{ $date }})</h1>
    <table style="border: 1px solid black; border-collapse: collapse; width:100%;">
        <tr>
            <th style="border: 1px solid black; width:40%; padding:0px 10px">Product</th>
            <th style="border: 1px solid black; width:10%; padding:0px 10px">Quantity</th>
            <th style="border: 1px solid black; width:50%; padding:0px 10px">Price</th>
        </tr>
        @foreach($sales_order->salesOrderProduct as $sales_order_product)
        <tr>
            <td style="border: 1px solid black; padding:0px 10px">{{ $sales_order_product->product_name }}</td>
            <td style="border: 1px solid black; padding:0px 10px">{{ $sales_order_product->quantity }}</td>
            <td style="border: 1px solid black; padding:0px 10px">{{ $sales_order_product->total_price }}</td>
        </tr>
        @endforeach
        <tr>
            <td style="border: 1px solid black; padding:0px 10px" colspan="2"><b>Subtotal:</b></td>
            <td style="border: 1px solid black; padding:0px 10px">{{ $sales_order->subtotal }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding:0px 10px" colspan="2"><b>Discount:</b></td>
            <td style="border: 1px solid black; padding:0px 10px">-{{ $sales_order->discount }}</td>
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
            <td style="border: 1px solid black; padding:0px 10px">{{ $sales_order->total }}</td>
        </tr>
    </table>
</div>
<div style="margin:20px 0px;">
    <table style="width:50%">
        <tr>
            <th style="text-align:left;" class="bold-color"><h1>Shipping Address</h1></th>
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
            <td><a href="https://wa.me/"{{ $sales_order->phone_no }}>{{ $sales_order->phone_no }}</a></td>
        </tr>
        <tr>
            <td><a href="mailto:"{{ $sales_order->email }}>{{ $sales_order->email }}</a></td>
        </tr>
    </table>
</div>
<p>Thanks for reading.</p>
</x-mail::message>
