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
                            <div class="top-status-cate top-desktop">
                                <div class="status">
                                    All (1)
                                </div>
                                <div class="status">
                                    On Hold (6)
                                </div>
                                <div class="status">
                                    Completed (0)
                                </div>
                                <div class="status">
                                    Canceled (0)
                                </div>
                            </div>
                            <div class="top-mobile">
                                <div class="collapse-wrapper">
                                    <a class="collapse-nav" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="account-nav" id="order-nav">
                                            <div class="nav-inner">
                                                <div class="nav-title status">
                                                    All (1)
                                                </div>
                                                <div class="arrow">
                                                    <img src="{{asset('assets/web/assets/img/voucher/down.png')}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="collapse collapse-nav-inner" id="collapseExample2">
                                <div class="status">
                                    All (1)
                                </div>
                                <div class="status">
                                    On Hold (6)
                                </div>
                                <div class="status">
                                    Completed (0)
                                </div>
                                <div class="status">
                                    Canceled (0)
                                </div>
                            </div>
                            <div class="table-wrap">
                                <table>
                                    <tr>
                                        <th>order</th>
                                        <th>date</th>
                                        <th>total</th>
                                        <th>status</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td>#9605</td>
                                        <td>August 16, 2023</td>
                                        <td>$702 for 2 items</td>
                                        <td>On hold</td>
                                        <td class="td-details"><a href="#" class="login-button">details</a></td>
                                    </tr>
                                    <tr>
                                        <td>#9605</td>
                                        <td>August 16, 2023</td>
                                        <td>$702 for 2 items</td>
                                        <td>On hold</td>
                                        <td class="td-details"><a href="#" class="login-button">details</a></td>
                                    </tr>
                                    <tr>
                                        <td>#9605</td>
                                        <td>August 16, 2023</td>
                                        <td>$702 for 2 items</td>
                                        <td>On hold</td>
                                        <td class="td-details"><a href="#" class="login-button">details</a></td>
                                    </tr>
                                    <tr>
                                        <td>#9605</td>
                                        <td>August 16, 2023</td>
                                        <td>$702 for 2 items</td>
                                        <td>On hold</td>
                                        <td class="td-details"><a href="#" class="login-button">details</a></td>
                                    </tr>
                                    <tr>
                                        <td>#9605</td>
                                        <td>August 16, 2023</td>
                                        <td>$702 for 2 items</td>
                                        <td>On hold</td>
                                        <td class="td-details"><a href="#" class="login-button">details</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="paginate-wrap">
                                <div class="pagination">
                                    <a href="#" class="left-right left"><img src="{{asset('assets/web/assets/img/account_order/left_1.png')}}" alt=""></a>
                                    <a href="#">1</a>
                                    <a href="#">2</a>
                                    <a href="#">3</a>
                                    <a href="#">4</a>
                                    <a href="#">5</a>
                                    <a href="#">6</a>
                                    <a href="#" class="left-right right"><img src="{{asset('assets/web/assets/img/account_order/right_1.png')}}" alt=""></a>
                                </div>
                            </div>
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
    $('.left').on('mouseover', function(){
        $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/left_2.png')}}');
    })
    $('.left').on('mouseleave', function(){
        $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/left_1.png')}}');
    })
    $('.left img').on('mouseover', function(){
        $(this).attr('src', '{{asset('assets/web/assets/img/account_order/left_2.png')}}');
    })
    $('.left img').on('mouseleave', function(){
        $(this).attr('src', '{{asset('assets/web/assets/img/account_order/left_1.png')}}');
    })
    $('.right').on('mouseover', function(){
        $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/right_2.png')}}');
    })
    $('.right').on('mouseleave', function(){
        $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/right_1.png')}}');
    })
    $('.right img').on('mouseover', function(){
        $(this).attr('src', '{{asset('assets/web/assets/img/account_order/right_2.png')}}');
    })
    $('.right img').on('mouseleave', function(){
        $(this).attr('src', '{{asset('assets/web/assets/img/account_order/right_1.png')}}');
    })

    $(document).ready(function(){
        $('#collapseExample2').on('shown.bs.collapse', function(){
            $('#order-nav .arrow').find('img').css('transform', 'rotate(180deg)');
        });

        $('#collapseExample2').on('hidden.bs.collapse', function(){
            $('#order-nav .arrow').find('img').css('transform', 'rotate(0deg)');
        });
    })

</script>
@endpush