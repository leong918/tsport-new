@extends('admin.layout.app')

@section('style')
    @parent  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
@endsection

@section('content') 
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Order List</strong>
                            </div>
                            <div class="card-body table-listing table-responsive">     
                                @include("sales_order::admin.search")
                                <div class="d-flex gap-1 my-2">
                                    <div><button class="btn btn-light" id="btn-select-all"><i class="fa-regular fa-square"></i></button></div>
                                    <div><button class="btn btn-danger"  data-url='{{route('admin.sales_order.deleteByList')}}' id="btn-delete-all"><i class="fa fa-trash"></i></button></div>
                                    <div><button class="btn btn-success" id="btn-export">Export (Shipany)</button></div>
                                </div>  
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Order ID</th>
                                            <th>Email</th>
                                            <th>Total</th>
                                            <th>Product</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    @parent
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                var selectedDates = []; 

                $('#searchDatePicker').tempusDominus({
                        localization: {
                            format: 'dd-MM-yyyy'
                        },
                        dateRange: true,
                        multipleDatesSeparator: ' - '
                    });

                var table = $('.table').DataTable({
                    bSort: true,
                    processing: true,
                    autoWidth: false,
                    serverSide: true,
                    ajax: {
                        url: '{!! route('admin.sales_order.index') !!}',
                        data: function (d) {
                            var form = {};
                            $.each($('#form').serializeArray(), function() {
                                form[this.name] = this.value;
                            });
                            d.form_data = form;
                        },
                        // complete: function(data) {
                        //     window.myLazyLoad.update(); // dynamically apply lazy load
                        // },
                    },
                    columns: [
                        {
                            data: 'checkbox',
                            name: 'checkbox',
                            searchable: false,
                            sortable: false,
                        },
                        {
                            data: 'sales_order_id',
                            name: 'sales_order_id'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                        {
                            data: 'product',
                            name: 'product'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            searchable: false,
                            sortable: false,
                        }
                    ]
                });

                $('#form-submit').click(function() {
                    table.draw();
                })

                // delete record
                $('table tbody').on('click', '.btn-delete', function(e) {
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
                                        table.ajax.reload();
                                    })
                                    .catch((e) => {
                                        console.error("error ", e)
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
                            table.ajax.reload();
                        }
                    });
                });

                //status changing
                $(document).on('click', '.editable', function(){
                    var inputType = $(this).data('input-type'); 
                    var column = $(this).data('column');
                    var url = $(this).data('url');
                    var currentData = $(this).data('original-data');
                    var inputGroup = $("<div class='input-group' data-input-type='" + inputType + "' data-column='" + column + "' data-url='" + url + "' data-original-data='" + currentData + "'></div>");
                    var inputField = '';
                    var dropdownListString = '';

                    if (inputType == 'select')
                    {
                        var dropdownList = $(this).data('dropdown-list');
                        dropdownListString = JSON.stringify(dropdownList);
                        var inputField = $("<select class='form-control'></select>").attr("data-dropdown-list", dropdownListString);

                        $.each(dropdownList, function(key, value) {
                            //using jquery data attribute
                            var option = $("<option></option>").attr("value", key).prop('disabled', currentData == 2 && key == 0 ? true : false).text(value);
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

                // Event handler for the edit button
                $(document).on('click', '#editButton', function(e){
                    e.preventDefault();
                    var inputType = $(this).parent().data('input-type');
                    var url = $(this).parent().data('url');
                    var column = $(this).parent().data('column');
                    var inputData = $(this).siblings(inputType).val();

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
                                title: '{{__("page.status_updated")}}',
                                text: response.data.level_change ? 'Sales Order Status Updated Successfully ! (Order ' + response.data.level_change + ' user\'s level previously!)' : '{{__("page.status_updated")}}',
                                icon: 'success',
                                confirmButtonClass: 'btn btn-success',
                                    confirmButtonText: '{{__("page.ok")}}',
                            }).then((result) => {
                                window.location.reload();
                            });
                        })
                        .catch(error => {
                            swal.fire({
                                title: '{{__("page.status_updated_failed")}}',
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
                    var originalDropdown =  $(this).siblings('select').data('dropdown-list'); 
                    var originalElement = $("<span class='editable btn-status badge bg-" +
                                            (originalData == 1 ? 'success' :
                                                (originalData == 0 ? 'primary' :
                                                    (originalData == 2 ? 'info' :
                                                        (originalData == 3 ? 'dark' :
                                                            (originalData == -1 ? 'danger' :
                                                                (originalData == -2 ? 'info' : 'secondary')))))) + 
                                            "' data-input-type='" + originalInputType + "' data-dropdown-list='" + 
                                            JSON.stringify(originalDropdown) + "' data-column='" + originalColumn + "' data-url='" + 
                                            originalUrl + "' data-original-data='" + originalData + "'></span>");
                    originalElement.html(originalDropdown[originalData] || "<i>Empty</i>");                    
                    $(this).parent().replaceWith(originalElement);
                });

                // Function to close editing mode
                function closeEditing(originalInputType, originalColumn, originalUrl, inputField, originalValue, originalDropdown) {
                    var jsonData = JSON.parse(originalDropdown);
                    var originalElement = $("<span class='editable btn-status badge bg-" +
                                            (originalValue == 1 ? 'success' :
                                                (originalValue == 0 ? 'primary' :
                                                    (originalValue == 2 ? 'info' :
                                                        (originalValue == 3 ? 'dark' :
                                                            (originalValue == -1 ? 'danger' :
                                                                (originalValue == -2 ? 'info' : 'secondary')))))) + 
                                            "' data-input-type='" + originalInputType + "' data-dropdown-list='" + 
                                            originalDropdown + "' data-column='" + originalColumn + "' data-url='" + 
                                            originalUrl + "' data-original-data='" + originalValue + "'></span>");
                    originalElement.html(jsonData[originalValue] || "<i>Empty</i>");
                    inputField.parent().replaceWith(originalElement);
                }

                //select all
                $(document).on('click', '#btn-select-all', function(e) {
                    var selectAllChecked = $(this).hasClass('selected');
                    $('.checkboxSelection').each(function (){
                        $(this).prop('checked', !selectAllChecked);
                    });
                    $(this).toggleClass('selected text-primary');
                    $(this).html(selectAllChecked ? '<i class="fa-regular fa-square"></i>' : '<i class="fa-solid fa-square-check"></i>');
                });

                //status toggle 
                $(document).on('click', '#btn-delete-all', function(e) {
                    e.preventDefault();
                    var selectedList = []
                    $('.checkboxSelection').each(function (){
                        if($(this).prop('checked') == true)
                        {
                            var orderId = $(this).data('id');
                            console.log(orderId);
                            selectedList.push(orderId);
                        }
                    });
                    
                    var url = $(this).data("url");
                    swal.fire({
                        title: 'Are you sure?',
                        text: 'This action is not able to be reverted.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, change it!',
                        cancelButtonText: 'Cancel',
                        customClass: {
                            confirmButton: "btn btn-success me-2",
                            cancelButton: "btn btn-danger ms-2"
                        },
                        buttonsStyling: false,
                        showLoaderOnConfirm: true,
                        preConfirm: (response) => {
                            if (response) {
                                return axios.post(url, { selectedList: selectedList})
                                    .then(() => {
                                        table.ajax.reload();
                                    })
                                    .catch((e) => {
                                        console.error("error ", e)
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
                                title: 'Updated!',
                                text: 'Record updated successfully!',
                                icon: 'success',
                            });
                            // reload datatables
                            table.ajax.reload();
                        }
                    });
                });

                //status toggle 
                $(document).on('click', '#btn-export', function(e) {
                    e.preventDefault();
                    var selectedList = []
                    $('.checkboxSelection').each(function (){
                        if($(this).prop('checked') == true)
                        {
                            var orderId = $(this).data('id');
                            selectedList.push(orderId);
                        }
                    });
                    if(selectedList.length > 0){
                        var url = "{!! route('admin.sales_order.exportByList') !!}";
                        url += "?selectedList="+selectedList.join();
                        window.location.href = url;
                    }else{
                        swal.fire({
                                title: 'Failed!',
                                text: 'Please select at least ONE record',
                                icon: 'error',
                            });
                    }

                });

                $(document).on('click', '#form-export', function(e) {
                    var form = {};
                    var url = "{!! route('admin.sales_order.exportByList') !!}";
                    url += "?";
                    
                    $.each($('#form').serializeArray(), function() {
                        form[this.name] = this.value;
                        url += `${this.name}=${this.value}&`
                    });
                    window.open(url, '_blank');
                })

            });
        });
    </script>
@endsection
