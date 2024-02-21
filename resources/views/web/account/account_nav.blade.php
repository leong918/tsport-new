<div class="col-xl-3 col-12">
    <div class="account-nav-dt">
        <div class="account-nav active">
            <div class="nav-inner">
                <img src="{{asset('assets/web/assets/img/account_nav/account_detail.png')}}" alt="">
                <div class="nav-title">
                    <a href="{{route('account.details')}}">Account Details</a>
                </div>
            </div>
        </div>
        <div class="account-nav">
            <div class="nav-inner">
                <img src="{{asset('assets/web/assets/img/account_nav/addresses.png')}}" alt="">
                <div class="nav-title">
                    <a href="{{route('account.address')}}">Addresses</a>
                </div>
            </div>
        </div>
        <div class="account-nav">
            <div class="nav-inner">
                <img src="{{asset('assets/web/assets/img/account_nav/orders.png')}}" alt="">
                <div class="nav-title">
                    <a href="{{route('account.order')}}">Orders</a>
                </div>
            </div>
        </div>
        <div class="account-nav">
            <div class="nav-inner">
                <img src="{{asset('assets/web/assets/img/account_nav/points.png')}}" alt="">
                <div class="nav-title">
                    <a href="{{route('account.point')}}">Points</a>
                </div>
            </div>
        </div>
        <div class="account-nav">
            <div class="nav-inner">
                <img src="{{asset('assets/web/assets/img/account_nav/log_out.png')}}" alt="">
                <div class="nav-title">
                    <a href="{{route('web.logout')}}">Log Out</a>
                </div>
            </div>
        </div>
    </div>
    <div class="account-nav-mobile">
        <div class="collapse-wrapper">
            <a class="collapse-nav" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <div class="account-nav active">
                    <div class="nav-inner">
                        @if(Request::is('account/info'))
                            <img src="{{asset('assets/web/assets/img/account_nav/account_detail.png')}}" alt="">
                        @elseif(Request::is('account/addresses'))
                            <img src="{{asset('assets/web/assets/img/account_nav/addresses.png')}}" alt="">
                        @elseif(Request::is('account/order'))
                            <img src="{{asset('assets/web/assets/img/account_nav/orders.png')}}" alt="">
                        @elseif(Request::is('account/point'))
                            <img src="{{asset('assets/web/assets/img/account_nav/points.png')}}" alt="">
                        @endif
                        <div class="nav-title">
                            @if(Request::is('account/info'))
                                <div>Account Details</div>
                            @elseif(Request::is('account/addresses'))
                                <div>Addresses</div>
                            @elseif(Request::is('account/order'))
                                <div>Orders</div>
                            @elseif(Request::is('account/point'))
                                <div>Points</div>
                            @endif
                        </div>
                        <div class="arrow">
                            <img src="{{asset('assets/web/assets/img/voucher/down.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="collapse collapse-nav-inner" id="collapseExample">
            @if(!Request::is('account/info'))
            <div class="account-nav">
                <div class="nav-inner">
                    <img src="{{asset('assets/web/assets/img/account_nav/account_detail.png')}}" alt="">
                    <div class="nav-title">
                        <a href="{{route('account.details')}}">Account Details</a>
                    </div>
                </div>
            </div>
            @endif
            @if(!Request::is('account/addresses'))
            <div class="account-nav">
                <div class="nav-inner">
                    <img src="{{asset('assets/web/assets/img/account_nav/addresses.png')}}" alt="">
                    <div class="nav-title">
                        <a href="{{route('account.address')}}">Addresses</a>
                    </div>
                </div>
            </div>
            @endif
            @if(!Request::is('account/order'))
            <div class="account-nav">
                <div class="nav-inner">
                    <img src="{{asset('assets/web/assets/img/account_nav/orders.png')}}" alt="">
                    <div class="nav-title">
                        <a href="{{route('account.order')}}">Orders</a>
                    </div>
                </div>
            </div>
            @endif
            @if(!Request::is('account/point'))
            <div class="account-nav">
                <div class="nav-inner">
                    <img src="{{asset('assets/web/assets/img/account_nav/points.png')}}" alt="">
                    <div class="nav-title">
                        <a href="{{route('account.point')}}">Points</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.collapse-nav-inner').on('shown.bs.collapse', function(){
            $('.arrow img').css('transform', 'rotate(180deg)');
        });

        $('.collapse-nav-inner').on('hidden.bs.collapse', function(){
            $('.arrow img').css('transform', 'rotate(0deg)');
        });
    })
</script>
@endpush