
<x-mail::message>
<div>
    <img src="{{ $image }}">
    <div style="padding:20px 0px; text-align:center; background-color:#aba470; color:white">A note has been added to your order</div>
</div>
<div style="margin: 20px 0px">
    <p>Hi {{ $sales_order->user->first_name }},</p>
    <p>Thank you for placing your order with us! We appreciate your business and would like to inform you about the shipping fee for your order #{{ $sales_order->sales_order_id }}.</p>
    <p style="margin-left:10px">The shipping fee for your order is HK${{ $sales_order->shipping }}. To proceed with the payment, please click on the following link: <a href="https://tag-concept.com/product/shipping-fee/">https://tag-concept.com/product/shipping-fee/</a></p>
    <p style="margin-left:10px">Once on the page, please add a quantity of {{ $sales_order->shipping }} to your shopping cart and proceed to pay the total amount of HK${{ $sales_order->shipping }}.</p>
    <p style="margin-left:10px">We aim to process and ship your order within 7-10 working days. Should there be any delays or changes in the shipping time frame, we will notify you promptly.</p>
    <p style="margin-left:10px">If you have any questions or require further assistance, please feel free to reach out to our customer service team. We are here to help.</p>
    <p style="margin-left:10px">Thank you once again for your order. We look forward to delivering your products to you soon.</p>    
    <p>As a reminder, here are your order details:</p>
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
            <th style="text-align:left; padding-bottom:20px;" class="bold-color"><h1>Shipping Address</h1></th>
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
