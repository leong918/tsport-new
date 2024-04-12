@extends('web.layout.app')
@section('content')
<div id="full-my-order" class="margin-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="forgot-password-title">My Account</div>
                <div class="nav-acc"><a href="#">Home</a> > <a href="#"> My Account </a> > <a href="#"> Orders </a></div>
                <div>

                </div>
            </div>
            @include('web.account.account_nav')
            <div class="col-xl-9 col-12">
                <div class="forgot-password-wrapper">
                    <div class="forgot-password-container">
                        <div class="empty-addr">
                            <div class="top-mobile">
                                <div class="collapse-wrapper">
                                    <a class="collapse-nav" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="account-nav" id="order-nav">
                                            <div class="nav-inner">
                                                <div class="nav-title status"></div>
                                                <div class="arrow">
                                                    <img class="m-0" src="{{asset('assets/web/assets/img/voucher/down.png')}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            {{ html()->form('GET', route("account.order"))->id('orderSortingForm')->open()}}
                            <div class="collapse collapse-nav-inner" id="collapseExample2">
                                <div class="status" data-order-status="all">
                                    All ({{ $all_count }})
                                </div>
                                <div class="status" data-order-status="0">
                                    Pending ({{ $pending_count }})
                                </div>
                                <div class="status" data-order-status="2">
                                    Processing ({{ $processing_count }})
                                </div>
                                <div class="status" data-order-status="1">
                                    Completed ({{ $completed_count }})
                                </div>
                                <div class="status" data-order-status="-2">
                                    Cancelled ({{ $cancelled_count }})
                                </div>
                                <input id="order_status_input" name="status" type="text" value="" hidden>
                            </div>
                            {{ html()->form()->close() }}
                            <div class="table-wrap">
                                <table>
                                    <tr>
                                        <th>order</th>
                                        <th>date</th>
                                        <th>total</th>
                                        <th>status</th>
                                        <th></th>
                                    </tr>
                                    @if ($order_list->isNotEmpty())
                                    @foreach ($order_list as $order)
                                    <tr class="sales_order_list">
                                        <td>{{ $order->sales_order_id }}</td>
                                        <td>{{ Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                                        <td>${{ $order->total }} for {{ $order->salesOrderProduct->count() }} items</td>
                                        <td>{{ array_key_exists($order->status, $order_status_list) ? ucfirst(strtolower($order_status_list[$order->status])) : null }}</td>
                                        <td class="td-details"><a href="{{route('account.order_detail', ['id' => $order->id])}}" class="login-button">details</a></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" style="text-align: center">No Record Found</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            @if ($currentStatus !== null)
                            {{ $order_list->appends(['status' => $currentStatus])->links() }}
                            @else
                            {{ $order_list->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var currentStatus = '';
        var searchParams = new URLSearchParams(window.location.search);
        searchParams.has('status') ? currentStatus = searchParams.get('status') : currentStatus = 'all';

        $('#collapseExample2 .status').each(function () {
            var order_status = $(this).data('order-status');
            order_status == currentStatus ? $('#order-nav .status').text($(this).text()) : null;
        });


        $('#collapseExample2').on('shown.bs.collapse', function(){
            $('#order-nav .arrow').find('img').css('transform', 'rotate(180deg)');
        });

        $('#collapseExample2').on('hidden.bs.collapse', function(){
            $('#order-nav .arrow').find('img').css('transform', 'rotate(0deg)');
        });

        $('#collapseExample2').on('click', '.status', function() {
            $('#order-nav .status').text($(this).text());
            $('.collapse').collapse('hide');
            $('#order_status_input').val($(this).data('order-status'));

            var order_status_input = $('#order_status_input').val();
            
            order_status_input != 'all' ? $('#orderSortingForm').trigger('submit') : location.replace("{{ route('account.order') }}");      
        });

        //---------------------- sales order pagination -------------------------
        $('nav').attr('id', 'orderPagination').addClass('paginate-wrap');
        $('#orderPagination .pagination').addClass('d-flex justify-content-center');
        $('#orderPagination .pagination .page-link').addClass('bg-transparent border-0 d-inline p-0 ms-2 me-2'); 
        $('#orderPagination .pagination .page-item:first-child .page-link').removeClass('border-0 p-0 ms-2 me-2').addClass('rounded-circle')
        .addClass('left').text('').append(`<img src="{{asset('assets/web/assets/img/account_order/left_1.png')}}" alt="">`);
        $('#orderPagination .pagination .page-item:last-child .page-link').removeClass('border-0 p-0 ms-2 me-2').addClass('rounded-circle')
        .addClass('right').text('').append(`<img src="{{asset('assets/web/assets/img/account_order/right_1.png')}}" alt="">`);

        $('.left').on('mouseover', function(){
            $(this).removeClass('bg-transparent');
            $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/left_2.png')}}');
        });
        $('.left').on('mouseleave', function(){
            $(this).addClass('bg-transparent');
            $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/left_1.png')}}');
        });
        $('.right').on('mouseover', function(){
            $(this).removeClass('bg-transparent');
            $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/right_2.png')}}');
        });
        $('.right').on('mouseleave', function(){
            $(this).addClass('bg-transparent');
            $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/right_1.png')}}');
        });
    })

</script>
@endpush