
<table>
    <thead>
        <tr>
            <th style="font-weight: bold; text-align: center;">Order Number</th>
            <th style="font-weight: bold; text-align: center;">Order Remarks</th>
            <th style="font-weight: bold; text-align: center;">Receiver Last Name</th>
            <th style="font-weight: bold; text-align: center;">Receiver First Name</th>
            <th style="font-weight: bold; text-align: center;">Receiver Phone Number</th>
            <th style="font-weight: bold; text-align: center;">Address</th>
            <th style="font-weight: bold; text-align: center;">Address - City</th>
            <th style="font-weight: bold; text-align: center;">Address - District/State/Province</th>
            <th style="font-weight: bold; text-align: center;">Address - Country/Region</th>
            <th style="font-weight: bold; text-align: center;">Address - Postcode</th>
            <th style="font-weight: bold; text-align: center;">E-mail</th>
            <th style="font-weight: bold; text-align: center;">SKU</th>
            <th style="font-weight: bold; text-align: center;">Product Name</th>
            <th style="font-weight: bold; text-align: center;">Dimension &amp; Weight</th>
            <th style="font-weight: bold; text-align: center;">Sale Price</th>
            <th style="font-weight: bold; text-align: center;">Currency</th>
            <th style="font-weight: bold; text-align: center;">Quantity</th>
            <th style="font-weight: bold; text-align: center;">Storage Type</th>
            <th style="font-weight: bold; text-align: center;">Paid By Receiver</th>
            <th style="font-weight: bold; text-align: center;">Sender Last Name</th>
            <th style="font-weight: bold; text-align: center;">Sender First Name</th>
            <th style="font-weight: bold; text-align: center;">Sender Phone Number</th>
            <th style="font-weight: bold; text-align: center;">Sender Address </th>
            <th style="font-weight: bold; text-align: center;">Sender Address - City</th>
            <th style="font-weight: bold; text-align: center;">Sender Address - District/State/Province</th>
            <th style="font-weight: bold; text-align: center;">Sender Address - Country/Region</th>
            <th style="font-weight: bold; text-align: center;">Sender - Postcode</th>
            <th style="font-weight: bold; text-align: center;">Sender E-mail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales_order_list as $item)
            <tr>
                <td>{{ $item['sales_order_id'] }}</td>
                <td>{{ $item['customer_note'] }}</td>
                <td>{{ $item['last_name'] }}</td>
                <td>{{ $item['first_name'] }}</td>
                <td>{{ $item['phone_no'] }}</td>
                <td>{{ $item['address'] }}</td>
                <td>{{ $item['city'] }}</td>
                <td>{{ $item['state'] }}</td>
                <td>{{ $item['country'] }}</td>
                <td>{{ $item['postcode'] }}</td>
                <td>{{ $item['email'] }}</td>
                <td>{{ $item['sku'] }}</td>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ $item['product_name'] }}</td>
                <td>1x1x1cm 0kg</td>
                <td>{{ $item['price'] }}</td>
                <td>HKD</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ $item['is_pay_later'] }}</td>
                <td>{{ $senderData['sender_last_name'] }}</td>
                <td>{{ $senderData['sender_first_name'] }}</td>
                <td>{{ $senderData['sender_phone_no'] }}</td>
                <td>{{ $senderData['sender_address'] }}</td>
                <td>{{ $senderData['sender_city'] }}</td>
                <td>{{ $senderData['sender_state'] }}</td>
                <td>{{ $senderData['sender_country'] }}</td>
                <td>{{ $senderData['sender_postcode'] }}</td>
                <td>{{ $senderData['sender_email'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
