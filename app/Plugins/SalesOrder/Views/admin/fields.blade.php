<x-alert />
<style>
    td{
        line-height: 1.6;
    }
</style>
<div class="row mb-5">
    <div class="col-xl-6">      
        <table class="table table-hover box-body text-wrap table-bordered">
            <tr>
                <th>{{ html()->label('Email :') }}</th>
                <td><div><span>{!! isset($model) && $model->email ? $model->email : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('First Name :') }}</th>
                <td><div><span class="editable" data-input-type="text" data-column="first_name" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->first_name}}">{!! isset($model) && $model->first_name ? $model->first_name : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('Last Name :') }}</th>
                <td><div><span class="editable" data-input-type="text" data-column="last_name" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->last_name}}">{!! isset($model) && $model->last_name ? $model->last_name : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('Company Name :') }}</th>
                <td><div><span class="editable" data-input-type="text" data-column="company_name" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->company_name}}">{!! isset($model) && $model->company_name ? $model->company_name : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('Address :') }}</th>
                <td><div><span class="editable" data-input-type="text" data-column="address" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->address}}">{!! isset($model) && $model->address ? $model->address : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('City :') }}</th>
                <td><div><span class="editable" data-input-type="text" data-column="city" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->city}}">{!! isset($model) && $model->city ? $model->city : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('State :') }}</th>
                <td><div><span class="editable" data-input-type="text" data-column="state" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->state}}">{!! isset($model) && $model->state ? $model->state : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('Country :') }}</th>
                <td><div><span class="editable"  data-input-type="select" data-dropdown-list='{{ json_encode($countryDropdown)}}'  data-column="country_id" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->country_id}}">{!! isset($model) && $model->country_id ? $countryDropdown[$model->country_id] : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('Postcode :') }}</th>
                <td><div><span class="editable" data-input-type="text" data-column="postcode" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->postcode}}">{!! isset($model) && $model->postcode ? $model->postcode : '<i>Empty</i>' !!}</span></div></td>
            </tr>
        </table>
    </div>
    <div class="col-xl-6">
        <table class="table table-hover box-body text-wrap table-bordered">
            <tr>
                <th>{{ html()->label('Tracking Number :') }}</th>
                <td><div><span class="editable" data-input-type="text" data-column="tracking_number" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->tracking_number}}">{!! isset($model) && $model->tracking_number ? $model->tracking_number : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('Order Status :') }}</th>
                <td><div><span class="editable" data-input-type="select" data-dropdown-list='{{ json_encode(array_flip(App\Plugins\SalesOrder\Models\SalesOrder::ORDER_STATUS)) }}' data-column="status" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->status}}">{!! isset($model) && isset($model->status) ? renderModelData(App\Plugins\SalesOrder\Models\SalesOrder::ORDER_STATUS, $model->status) : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('Shipping Method:') }}</th>
                <td><div><span class="editable" data-input-type="text" data-column="delivery_partner" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->delivery_partner}}">{!! isset($model) && $model->delivery_partner ? $model->delivery_partner : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('Payment Method :') }}</th>
                <td><div><span class="editable" data-input-type="select" data-dropdown-list='{{ json_encode(array_flip(App\Plugins\SalesOrder\Models\SalesOrder::PAYMENT_METHOD)) }}' data-column="payment_method" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->payment_method}}">{!! isset($model) && isset($model->payment_method) ? renderModelData(App\Plugins\SalesOrder\Models\SalesOrder::PAYMENT_METHOD, $model->payment_method) : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('Earned Points :') }}</th>
                <td><div><span class="editable" data-input-type="number" data-column="point_earned" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->point_earned}}">{!! $model->point_earned ?? '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <th>{{ html()->label('Created At :') }}</th>
                <td><div><span>{!! isset($model) && $model->created_at ? $model->created_at : '<i>Empty</i>' !!}</span></div></td>
            </tr>
        </table>
    </div>
    <div class="col-12">
        <table id="salesOrderProductTable" class="table table-hover box-body text-wrap table-bordered">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
            @foreach($model->salesOrderProduct as $sales_order_product)
                <tr>
                    <td>
                        {{ $sales_order_product->product_name }}
                        @if ($sales_order_product->product_attribute_term_name)
                            <br>
                            {!! $sales_order_product->product_attribute_term_name !!}
                        @endif
                    </td>
                    <td><div><span class="editable" data-input-type="number" data-column="price" data-url="{{ route('admin.sales_order.updateProduct.put',["id" => $model->id, "product_id" => $sales_order_product->id]) }}" data-original-data="{{ $sales_order_product->price }}">{{ $sales_order_product->price }}</span></div></td>
                    <td>{{ $sales_order_product->quantity }}</td>
                    <td>{{ $sales_order_product->total_price }}</td>
                    <td><button type="button" data-url="{{ route('admin.sales_order.destroy.deleteProduct', ["id" => $model->id, "product_id" => $sales_order_product->id]) }}" class="btn btn-danger btn-delete"><i class="fa-solid fa-trash"></i></button></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="8">
                    <button type="button" class="btn btn-success" id="addNewButton"><i class="fa-solid fa-plus"></i> Add New</button>
                    <button type="button" class="btn btn-warning" id="saveButton" style="display: none;"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-xl-6">
        <table  class="table table-hover box-body text-wrap table-bordered">
            @foreach($model->salesOrderTotal as $sales_order_total)
                <tr>
                    <td>{{ $sales_order_total->title }}</td>
                    @if($sales_order_total->code != "total" && $sales_order_total->code != "subtotal")
                        <td><div><span class="editable" data-input-type="number" data-column="order_total_{{ $sales_order_total->id}}" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{ $sales_order_total->value }}">{{($sales_order_total->code == 'discount' || $sales_order_total->code == 'coupon' || $sales_order_total->code == 'point_redeemption' ? '- ' : '') . $sales_order_total->value }}</span></div></td>
                    @else
                        <td><div><span>{{ $sales_order_total->value }}</span></div></td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-xl-6">
        <table  class="table table-hover box-body text-wrap table-bordered">
            <tr>
                <td><b>Customer Note</b></td>
                <td><div><span class="editable" data-input-type="textarea" data-column="customer_note" data-url="{{ route('admin.sales_order.update.put',["id" => $model->id]) }}" data-original-data="{{$model->customer_note}}">{!! isset($model) && $model->customer_note ? $model->customer_note : '<i>Empty</i>' !!}</span></div></td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Order History</b><br>
                    <div class="table-responsive">
                        <table class="table table-bordered m-0 mt-2">
                            <tr>
                                <th>Staff</th>
                                <th>Content</th>
                                <th>Time</th>
                            </tr>
                            @foreach ($model->salesOrderLog as $sales_order_log)
                                <tr>
                                    <td>{{ $sales_order_log->admin_id ? $sales_order_log->admin->name : $sales_order_log->user->first_name }}</td>
                                    <td>{!! $sales_order_log->description !!}</td>
                                    <td>{{ $sales_order_log->created_at }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
@section('script')
@parent
<script src="https://cdn.jsdelivr.net/npm/mustache@4.2.0/mustache.min.js"></script>
<script id="addProductContent" type="x-tmpl-mustache">
    <tr class="addProductRow">
        <td>
            <select class="form-control productListDropdown" required>
                <option value="" disabled selected>Select product</option>
                @{{#dropdownOptions}}
                    <option value="@{{ id }}" data-product-price="@{{ price }}">@{{ name }}</option>
                @{{/dropdownOptions}}
            </select>
            <div class="product_attribute_list"></div>
        </td>
        <td><input type="number" name="price" class="form-control priceInput" step="0.01" min="0.00" required></td>
        <td><input type="number" name="quantity" class="form-control quantityInput" required></td>
        <td><input type="number" name="total_price" class="form-control totalPriceInput" disabled readonly required></td>
        <td><button type="button" class="btn btn-danger removeButton"><i class="fa-solid fa-xmark"></i></button></td>
    </tr>
</script>
<script>
var template = document.getElementById('addProductContent').innerHTML;
var productListDropdown = <?php echo json_encode($productListDropdown)?>;

$(document).ready(function(){
    $(document).on('click', '.editable', function(){
        var inputType = $(this).data('input-type'); 
        var column = $(this).data('column');
        var url = $(this).data('url');
        var currentData = $(this).data('original-data');
        var inputGroup = $("<div class='input-group' data-input-type='" + inputType + "' data-column='" + column + "' data-url='" + url + "' data-original-data='" + currentData + "'></div>");;
        var inputField = '';
        var dropdownListString = '';
        if(inputType == 'text')
        {
            inputField = $("<input type='text' class='form-control'>").val(currentData)
        }else if (inputType == 'number')
        {
            inputField = $("<input type='number' class='form-control' min='0.00' step='0.01'>").val(currentData)
        }else if (inputType == 'textarea')
        {
            inputField = $("<textarea rows='4' cols='50'>").val(currentData)
        }else if (inputType == 'select')
        {
            var dropdownList = $(this).data('dropdown-list');
            dropdownListString = JSON.stringify(dropdownList);
            var inputField = $("<select class='form-control'></select>").attr("data-dropdown-list", dropdownListString);

            $.each(dropdownList, function(key, value) {
                //using model status
                var modelStatus = "{{ $model->status }}";
                var option = $("<option></option>").attr("value", key).prop('disabled', modelStatus == 2 && key == 0 ? true : false).text(value);
                inputField.append(option);
            });
            inputField.val(currentData);
        }

        var editButton = $("<button id='editButton' type='button' class='btn btn-primary'><i class='fa-solid fa-check'></i></button>");
        var closeButton = $("<button id='closeEditButton' type='button' class='btn btn-secondary'><i class='fa-solid fa-xmark'></i></button>");
        inputGroup.append(inputField);
        inputGroup.append(editButton);
        inputGroup.append(closeButton);
        $(this).replaceWith(inputGroup);

        $(document).on('click', function(event){
            if (!$(event.target).closest('.input-group').length) {
                closeEditing(inputType, column, url, inputField, currentData, dropdownListString ?? null);
            }
        });
    });

    $(document).on('click', '#editButton', function(e){
        e.preventDefault();
        var inputType = $(this).parent().data('input-type');
        var url = $(this).parent().data('url');
        var column = $(this).parent().data('column');
        var inputData = '';
        if(inputType == 'select' || inputType == 'textarea'){
            inputData = $(this).siblings(inputType).val();
        }else{
            inputData = $(this).siblings('input[type="'+inputType+'"]').val();
        }

        var formData = new FormData();
        formData.append(column, inputData);
        axios({
                method: "post",
                url: url,
                data: formData,
                headers: { "Content-Type": "multipart/form-data" },
            })
            .then(response => {
                swal.fire({
                    title: '{{__("page.sales_order_edited")}}',
                    text: response.data.level_change ? 'Sales Order Edited Successfully ! (Order ' + response.data.level_change + ' user\'s level previously!)' : '{{__("page.sales_order_edited")}}',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                        confirmButtonText: '{{__("page.ok")}}',
                }).then((result) => {
                    window.location.reload();
                });
            })
            .catch(error => {
                swal.fire({
                    title: '{{__("page.sales_order_failed")}}',
                    text: error.response.data.msg,
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: '{{__("page.ok")}}',
                });
            });
    });

    // Event handler for the close button
    $(document).on('click', '#closeEditButton', function(){
        var originalInputType = $(this).parent().data('input-type');
        var originalColumn = $(this).parent().data('column');
        var originalUrl = $(this).parent().data('url');
        var originalData = $(this).parent().data('original-data');
        var originalElement = '';
        if(originalInputType == 'text' || originalInputType == 'number'){
            originalElement = $("<span class='editable' data-input-type='" + originalInputType + "' data-column='" + originalColumn + "' data-url='" + originalUrl + "' data-original-data='" + originalData + "'></span>").html(originalData);
        }else if (originalInputType == 'select'){
            if(originalColumn == 'status'){
                var rendering = "<?php if(isset($model)) echo renderModelData(App\Plugins\SalesOrder\Models\SalesOrder::ORDER_STATUS, $model->status); ?>";
            }else if (originalColumn == 'payment_method'){
                var rendering = "<?php if(isset($model)) echo renderModelData(App\Plugins\SalesOrder\Models\SalesOrder::PAYMENT_METHOD, $model->payment_method); ?>";
            }else if(originalColumn == 'country_id'){
                var rendering = "<?php if(isset($model)) echo $countryDropdown[$model->country_id] ?>";
            }
            var originalDropdown =  $(this).siblings('select').data('dropdown-list'); 
            originalElement = $("<span class='editable' data-input-type='" + originalInputType + "' data-dropdown-list='" + JSON.stringify(originalDropdown) + "'' data-column= '" + originalColumn + "' data-url='" + originalUrl + "' data-original-data='" + originalData + "'></span>").html(rendering);

        }
        $(this).parent().replaceWith(originalElement);
    });

    // Function to close editing mode
    function closeEditing(originalInputType, originalColumn, originalUrl, inputField, originalValue, originalDropdown = null) {
        var originalElement = '';
        if(originalDropdown){
            if(originalColumn == 'status'){
                var rendering = "<?php if(isset($model)) echo renderModelData(App\Plugins\SalesOrder\Models\SalesOrder::ORDER_STATUS, $model->status); ?>";
            }else if (originalColumn == 'payment_method'){
                var rendering = "<?php if(isset($model)) echo renderModelData(App\Plugins\SalesOrder\Models\SalesOrder::PAYMENT_METHOD, $model->payment_method); ?>";
            }else if(originalColumn == 'country_id'){
                var rendering = "<?php if(isset($model)) echo $countryDropdown[$model->country_id] ?>";
            }
            originalElement = $("<span class='editable' data-input-type='" + originalInputType + "' data-dropdown-list='" + originalDropdown + "'' data-column= '" + originalColumn + "' data-url='" + originalUrl + "' data-original-data='" + originalValue + "'></span>").html(rendering);
        }else{
            originalElement = $("<span class='editable' data-input-type='" + originalInputType + "' data-column='" + originalColumn + "' data-url='" + originalUrl + "' data-original-data='" + originalValue + "'></span>").html(originalValue != null && originalValue != "" ? originalValue : "<i>Empty</i>");
        }
        inputField.parent().replaceWith(originalElement);
    }

    //Mustache Function
    $(document).on('click', '#addNewButton', function(){
        var index = $('#salesOrderProductTable tr').length-1;
        var rendered = Mustache.render(template, {
            dropdownOptions: productListDropdown
        });
        $('#salesOrderProductTable tbody tr').eq(index).before(rendered);

        if($('.addProductRow').length > 0)
        {
            $('#saveButton').show();
        }else{
            $('#saveButton').hide();
        }
    });

    //Function to save added product
    $(document).on('click', '#saveButton', function(){
        var productList = [];
        $('.addProductRow').each(function(index, element){
            var product= {};
            var inputs = $(this).find('input, select');
    
            var emptyInputs = inputs.filter(function() {
                return !$(this).val(); // Filter out input/select elements without a value
            });

            if(emptyInputs.length <= 0)
            {
                var selected_product_attribute = {};
                $(this).find('.attribute_ul_list').each(function(){
                    var selectedRadioBtn = $(this).find('input[type="radio"]:checked');
                    selected_product_attribute[selectedRadioBtn.data('attribute_id')] = selectedRadioBtn.val();
                })

                product.product_id = $(this).find('select').val();
                product.price = $(this).find('input[name="price"]').val();
                product.quantity = $(this).find('input[name="quantity"]').val();
                product.total_price = $(this).find('input[name="total_price"]').val();
                product.attribute = JSON.stringify(selected_product_attribute);
                productList.push(product);
            }else{
                swal.fire({
                    title: '{{__("page.sales_order_failed")}}',
                    text: '{{__("page.some input fields are empty")}}',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: '{{__("page.ok")}}',
                });

                productList = [];
            }
        });
        if (productList.length > 0) {
            axios({
                method: "post",
                url: '{!! route('admin.sales_order.updateProduct.put',['id' => $model->id]) !!}',
                data: productList,
                headers: { "Content-Type": "multipart/form-data" },
            })
            .then(response => {
                swal.fire({
                    title: '{{__("page.sales_order_edited")}}',
                    text: '{{__("page.sales_order_edited")}}',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                        confirmButtonText: '{{__("page.ok")}}',
                }).then((result) => {
                        window.location.reload();
                });
            })
            .catch(error => {
                swal.fire({
                    title: '{{__("page.sales_order_failed")}}',
                    text: error.response.data.msg,
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: '{{__("page.ok")}}',
                });
            });
        }
    });

    //Function to remove row
    $(document).on('click', '.removeButton', function(){
        $(this).parents('.addProductRow').remove();

        if($('.addProductRow').length > 0)
        {
            $('#saveButton').show();
        }else{
            $('#saveButton').hide();
        }

        $(".addProductRow").each(function(index) {
            var ulList = $(this).find('.attribute_ul_list');
            ulList.each(function(){
                var radioBtns = $(this).find('input[type="radio"]');
                var parts = radioBtns.attr('name').split('-');
                parts[2] = index + 1;
                var modifiedRadioBtnNaming = parts.join('-');
                radioBtns.attr('name', modifiedRadioBtnNaming);
            })
        });
    });

    // Function for product list dropdown
    $(document).on('change', '.productListDropdown', function(){
        var selectedOption = $(this).find('option:selected');
        var productPrice = selectedOption.attr('data-product-price');
        var routeUrl = "{{ route('admin.product.getProductAttribute', ['id' => ':id']) }}";
        var apiUrl = routeUrl.replace(':id', selectedOption.val());
        var listContainer = $(this).closest('td').find('.product_attribute_list');
        listContainer.empty();
        axios.get(apiUrl)
            .then((response) => {
                    var attribute_list = response.data.product_attribute;
                    if(!attribute_list.hasOwnProperty("")){
                        var attributeIndex = 1;
                        var currentRowIndex = $('.addProductRow').index($(this).closest('.addProductRow')) + 1;
                        for (let key in attribute_list) {
                            if (attribute_list.hasOwnProperty(key)) {
                                listContainer.addClass('mt-2');
                                    var list = $('<ul>').attr('class','ps-3 pb-0 pt-2 list-unstyled attribute_ul_list').text(key);
                                        attribute_list[key].forEach(function(item){
                                            var  li = $("<li>");
                                            var radioButton = $("<input>").attr({"type": "radio","name": 'attribute-' + attributeIndex + '-'+currentRowIndex,"class": "m-2", "required":"required"}).val(item.id).data('attribute-price', item.price).data('attribute_id', item.product_attribute_id);
                                            li.append(radioButton, item.name + "(+" + item.code + " " + item.price + ") ");
                                            list.append(li);
                                        });
                                //checked the first attribute
                                list.find('li input[type="radio"]').first().prop('checked', true);
                            }
                            attributeIndex++ ;
                            listContainer.append(list);
                        }

                        // Update the value of the priceInput field
                        var ulList = $(this).closest('.addProductRow').find('.attribute_ul_list');
                        var selectedProductPrice = parseFloat($(this).closest('.addProductRow').find('.productListDropdown option:selected').data('product-price'));
                        ulList.each(function(){
                            var selectedAttribute = $(this).find('input[type="radio"]:checked');
                            if(selectedAttribute.length > 0){
                                selectedProductPrice += parseFloat(selectedAttribute.data('attribute-price'));
                            }
                        });
                        selectedProductPrice = selectedProductPrice.toFixed(2);
                        $(this).closest('.addProductRow').find('.priceInput').val(selectedProductPrice);
                        $(this).closest('.addProductRow').find('.quantityInput').val(1);
                        $(this).closest('.addProductRow').find('.totalPriceInput').val(selectedProductPrice);
                    }
                });
    });

    $(document).on('change', '.product_attribute_list input[type="radio"]', function() {
        var ulList = $(this).closest('.addProductRow').find('.attribute_ul_list');
        var selectedProductPrice = parseFloat($(this).closest('.addProductRow').find('.productListDropdown option:selected').data('product-price'));
        ulList.each(function(){
            var selectedAttribute = $(this).find('input[type="radio"]:checked');
            if(selectedAttribute.length > 0){
                selectedProductPrice += parseFloat(selectedAttribute.data('attribute-price'));
            }
        });
        selectedProductPrice = selectedProductPrice.toFixed(2);
        var qty = parseInt($(this).closest('.addProductRow').find('.quantityInput').val());
        var finalProductPrice = (selectedProductPrice * qty).toFixed(2);
        $(this).closest('.addProductRow').find('.priceInput').val(selectedProductPrice);
        $(this).closest('.addProductRow').find('.totalPriceInput').val(finalProductPrice);
    });

    $(document).on('change', '.priceInput', function(){
        var quantity =  parseInt($(this).closest('.addProductRow').find('.quantityInput').val());
        var totalPrice = parseFloat($(this).val()) * quantity;
        $(this).closest('.addProductRow').find('.totalPriceInput').val(totalPrice.toFixed(2));
    });

    $(document).on('change', '.quantityInput', function(){
        var productPrice =  parseFloat($(this).closest('.addProductRow').find('.priceInput').val());
        var totalPrice = productPrice * parseInt($(this).val());
        $(this).closest('.addProductRow').find('.totalPriceInput').val(totalPrice.toFixed(2));
    });

    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        swal.fire({
            title: 'Are you sure?',
            text: 'This action is not able to be reverted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: "btn btn-success me-2",
                cancelButton: "btn btn-danger ms-2"
            },
            buttonsStyling: false,
            showLoaderOnConfirm: true,
            preConfirm: (response) => {
                if (response) {
                    return axios.delete(url, {})
                        .then(() => {
                            location.reload();
                        })
                        .catch((e) => {
                            Swal.showValidationMessage(
                                `Request failed: ${e}`
                            );
                        })
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                swal.fire({
                    title: 'Deleted!',
                    text: 'Record deleted successfully!',
                    icon: 'success',
                });
                // reload datatables
                location.reload();
            }
        });
    });
});
</script>
@endsection