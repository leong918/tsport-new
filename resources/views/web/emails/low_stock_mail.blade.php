@component('mail::layout')

    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('assets/web/assets/img/global/logo.png')}}" style="width:auto" class="logo" alt="Tag Concept Logo">
        @endcomponent
    @endslot

    <div style="">
        <p><b>Hello!</b></p>
        <p>Please alert that below products have low quantities. </p>
        <div style="margin:20px 0px;">
            <h2>Reported at <span style="color: #aba470;">({{ $date }})</span></h2>
            <table style="border: 1px solid black; border-collapse: collapse; width:100%; font-size:14px;">
                <tr>
                    <th style="border: 1px solid black; width:30%; padding:0px 10px; text-align:left">SKU</th>
                    <th style="border: 1px solid black; width:50%; padding:0px 10px; text-align:left">Product</th>
                    <th style="border: 1px solid black; width:20%; padding:0px 10px; text-align:left">Quantity</th>
                </tr>
                @foreach($low_stock_product_list as $low_stock_product)
                <tr>
                    <td style="border: 1px solid black; padding:0px 10px">{{ $low_stock_product->sku }}</td>
                    <td style="border: 1px solid black; padding:0px 10px">{{ $low_stock_product->name }}</td>
                    <td style="border: 1px solid black; padding:0px 10px">{{ $low_stock_product->quantity }}</td>
                </tr>
                @endforeach
                @foreach($low_stock_product_attribute_term_list as $low_stock_product_attribute_term)
                <tr>
                    <td style="border: 1px solid black; padding:0px 10px">{{ $low_stock_product_attribute_term->sku }}</td>
                    <td style="border: 1px solid black; padding:0px 10px">{{ $low_stock_product_attribute_term->product_name. " (".$low_stock_product_attribute_term->name.") " }}</td>
                    <td style="border: 1px solid black; padding:0px 10px">{{ $low_stock_product_attribute_term->quantity }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

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
