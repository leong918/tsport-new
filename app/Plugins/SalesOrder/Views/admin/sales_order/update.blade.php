@extends('admin.layout.app')

@section('style')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/dist/bootstrap5-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

<style>
    .editable {
        cursor: pointer;
        color: #0d6efd;
        border-bottom: 1px dashed #0d6efd;
    }
    .editable:hover {
        border-bottom: 1px dashed #0d6efd;
    }
    .editable.editing {
        border:none;
    }
</style>

@section("content")
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="d-flex flex-column justify-content-center"><strong>Order Details #{{ $model->sales_order_id }}</strong></div> 
                                    <div class="d-flex gap-1">
                                        <select class="form-control" id="mail_list">
                                            <option value="">Select at least one email</option>
                                            <option value="shipping_fee">Shipping Fee</option>
                                            <option value="tracking_number">Tracking Number</option>
                                            <option value="new_order">New Order</option>
                                            <option value="order_received">Order Received</option>
                                        </select>
                                        <button type="button" id="btn-mail" data-url="{{ route("admin.sales_order.sendMail", ["id" => $model->id]) }}" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                                {{ html()->model($model)->form('PUT', route("admin.sales_order.update.put", ["id" => $model->id]))->id('sales_order')->open() }}
                                <div class="card-body">
                                    @include("sales_order::admin.sales_order.fields")
                                </div>
                                {{ html()->form()->close() }}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
@parent
<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            $("#btn-mail").click(function(e) {
                e.preventDefault();
                var selectedMail = $("#mail_list").val();
                var mailTitle = selectedMail == 'tracking_number' ? "Tracking Number" : selectedMail == 'shipping_fee' ? "Shipping Fee" : selectedMail == 'new_order' ? "New Order" : "Order Received";
                var url = $(this).data("url");
                if(selectedMail){
                    swal.fire({
                        title: 'Are you sure',
                        text: 'This action will send '+ mailTitle +' email to the user.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonClass: 'btn btn-success',
                        confirmButtonText: 'Confirm',
                        preConfirm: (response) => {
                            if (response) {
                                return axios.post(url, { selectedMail: selectedMail})
                                    .then(() => {
                                        swal.fire({
                                            title: 'Success!',
                                            text: mailTitle + ' email sent successfully!',
                                            icon: 'success',
                                        });
                                    })
                                    .catch(error => {
                                        console.log(error)
                                        swal.fire({
                                            title: 'Failed to send email !',
                                            text: error.response.data.error,
                                            icon: 'error',
                                            confirmButtonClass: 'btn btn-danger',
                                            confirmButtonText: 'OK',
                                        });
                                    });
                            }
                        },
                    });
                }else{
                    swal.fire({
                        title: 'Alert',
                        text: 'Please select email to send',
                        icon: 'info',
                        confirmButtonClass: 'btn btn-success',
                        confirmButtonText: 'OK',
                    });
                }

            });
        });
    });
</script>
@endsection