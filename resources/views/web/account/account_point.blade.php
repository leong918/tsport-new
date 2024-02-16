@extends('web.layout.app')
@section('content')
<div id="points" class="margin-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="forgot-password-title">My Account</div>
                <div class="nav-acc"><a href="#">Home</a> > <a href="#"> My Account </a> > <a href="#"> Points </a></div>
            </div>
            @include('web.account.account_nav')
            <div class="col-xl-9 col-12">
                <div class="forgot-password-wrapper">
                    <div class="forgot-password-container">
                        <div class="empty-addr">
                        <div class="top-status-cate">
                                <div class="status title-points">
                                    My Points
                                </div>
                                <div class="status">
                                    You have 10 Points
                                </div>
                            </div>
                            <div class="table-wrap">
                                <table>
                                    <tr>
                                        <th>event</th>
                                        <th>date</th>
                                        <th>points</th>
                                        <th>expired date</th>
                                    </tr>
                                    <tr>
                                        <td>Points earned for account signup!</td>
                                        <td>August 16, 2023</td>
                                        <td>+10</td>
                                        <td>August 16, 2023</td>
                                    </tr>
                                    <tr>
                                        <td>Points earned for account signup!</td>
                                        <td>August 16, 2023</td>
                                        <td>+10</td>
                                        <td>August 16, 2023</td>
                                    </tr>
                                    <tr>
                                        <td>Points earned for account signup!</td>
                                        <td>August 16, 2023</td>
                                        <td>+10</td>
                                        <td>August 16, 2023</td>
                                    </tr>
                                    <tr>
                                        <td>Points earned for account signup!</td>
                                        <td>August 16, 2023</td>
                                        <td>+10</td>
                                        <td>August 16, 2023</td>
                                    </tr>
                                    <tr>
                                        <td>Points earned for account signup!</td>
                                        <td>August 16, 2023</td>
                                        <td>+10</td>
                                        <td>August 16, 2023</td>
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
    $('.right').on('mouseover', function(){
        $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/right_2.png')}}');
    })
    $('.right').on('mouseleave', function(){
        $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/right_1.png')}}');
    })
</script>
@endpush