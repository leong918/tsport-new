<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
            @font-face {
                font-family: 'fireflysung';
                src: url('{{ asset("assets/web/assets/fonts/fireflysung/fireflysung.ttf") }}') format('truetype'),
                    url('{{ asset("assets/web/assets/fonts/fireflysung/fireflysung.woff") }}') format('woff'),
                    url('{{ asset("assets/web/assets/fonts/fireflysung/fireflysung.woff2") }}') format('woff2');
                font-weight: normal;
            }
        body{
            margin-top:20px;
            font-size: 13px;
            font-family: 'fireflysung', 'DejaVu Sans', sans-serif !important;
        }
    </style>
</head>
<body>
    
    {{-- header --}}
    <div style="margin:20px 0px"><span style="font-size:25px; color:#d89c34;"><b>INVOICE</b></span></div>
    <img src="{{asset('assets/web/assets/img/global/logo.png')}}" style="max-height:80px; margin-bottom:20px;" class="logo" alt="Tag Concept Logo">

    {{-- info --}}
    <table style="width:100%; margin:20px 0;">
        <td style="width:70%">
            <table>
                <tr>
                    <th style="text-align:left;">Shipping Address</th>
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
        </td>
        <td style= "width:30%">
            <table style="font-family:DejaVu Sans !important;">
                <tr>
                    <th style="text-align:left; color:red;">Order No.:&nbsp;</th>
                    <th>{{ $sales_order->sales_order_id  }}</th>
                </tr>
                <tr>
                    <td><b>Order Date:&nbsp;</b></td>
                    <td><b>{{ date('d-m-Y', strtotime($sales_order->created_at)) }}</b></td>
                </tr>
            </table>
        </td>
    </table>

    {{-- product --}}
    <table style="width:100%; border-collapse: collapse; margin-bottom:20px;">
        <tr style="background-color:#e0c494;">
            <th style="width:10% !important; padding:10px; text-align:left;">S.NO</th>
            <th style="width:15% !important; padding:10px; text-align:left;">SKU</th>
            <th style="width:30% !important; padding:10px; text-align:left;">PRODUCT</th>
            <th style="width:10% !important; padding:10px; text-align:left;">QUANTITY</th>
            <th style="width:10% !important; padding:10px; text-align:left;">PRICE</th>
            <th style="width:15% !important; padding:10px; text-align:left;">TOTAL PRICE</th>
        </tr>
        @foreach($sales_order->salesOrderProduct as $index => $sales_order_product)
        <tr style="">
            <td style="border-bottom: 1px solid grey; padding:10px; width:10%;">{{ $index + 1 }}</td>
            <td style="border-bottom: 1px solid grey; padding:10px; width:15%;">{{ !empty(json_decode($sales_order_product->product_attribute_term)) ? $sales_order_product->getProductAttributeTermSKU() : $sales_order_product->product->sku }}</td>
            <td style="border-bottom: 1px solid grey; padding:10px; width:30%; word-wrap: break-word;">{{ $sales_order_product->product_name }}</td>
            <td style="border-bottom: 1px solid grey; padding:10px; width:10%;">{{ $sales_order_product->quantity }}</td>
            <td style="border-bottom: 1px solid grey; padding:10px; width:10%;">${{ $sales_order_product->price }}</td>
            <td style="border-bottom: 1px solid grey; padding:10px; width:15%;">${{ $sales_order_product->total_price }}</td>
        </tr>
        @endforeach
        <tr>
            <td style="width:75%;" colspan="4"></td>
            <td style="width:10%; padding:10px;">Subtotal</td>
            <td style="width:15%; padding:10px;">${{ $sales_order->subtotal }}</td>
        </tr>
        <tr>
            <td style="width:75%;" colspan="4"></td>
            <td style="width:10%; padding:10px;">Shipping</td>
            <td style="width:15% !important; padding:10px; word-wrap: break-word; max-width:100px">
                    [Free shipping 免運費 | 如寄 往順豐站/智能 櫃，直接輸入 點碼即可 ] 如果訂單包含預 訂商品，我們 將暫時擱置整個訂單，直到所有商品都齊貨才會將訂單寄出。 如客人
                    要求先寄出現 貨，滿$800的 訂單我們只會 負責第一次寄 貨的費用，第二次及隨後寄 貨的費用一律 到付由買家負責。
                {{-- 123 --}}
            </td>
        </tr>
        <tr style="border-bottom: 1px solid grey">
            <td style="width:75%;" colspan="4"></td>
            <td style="width:10%; padding:10px;">Cart Discount</td>
            <td style="width:15%; padding:10px;">-${{ $sales_order->discount }}</td>
        </tr>
        <tr style="border-bottom: 1px solid grey">
            <td style="width:75%;" colspan="4"></td>
            <td style="width:10%; padding:10px;">Total</td>
            <td style="width:15%; padding:10px;"><b>${{ $sales_order->total }}</b></td>
        </tr>
    </table>
    <div style="margin-bottom:60px">Payment method: 支付寶HK(Alipay HK) or Direct bank transfer (FPS)</div>
    <div>www.tag-concept.com│WhatsApp: +852-54425298│Thank you for your purchase!</div>
</body>
</html>