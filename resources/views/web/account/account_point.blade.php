@extends('web.layout.app')
@section('content')
<div id="points" class="margin-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="forgot-password-title">My Account</div>
                <div class="nav-acc"><a href="{{route('web.home')}}">Home</a> > <a href="#"> My Account </a> > <a href="#"> Points </a></div>
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
                                    You have {{ $user->point }} Points
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
                                    @foreach ($point_list as $point)
                                    <tr>
                                        <td>{{ $point->remark }}</td>
                                        <td> {{ Carbon\Carbon::parse($point->created_at)->format('M d, Y') }}</td>
                                        <td>{{ $point->type == 'IN' ? '+' : '-' }}{{ $point->point }}</td>
                                        <td>{{ $point->expired_at != null ? Carbon\Carbon::parse($point->expired_at)->format('M d, Y') : '-'}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            {{ $point_list->links() }}
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

    $(document).ready(function() {
        $('nav').attr('id', 'pointPagination').addClass('paginate-wrap');
        $('#pointPagination .pagination').addClass('d-flex justify-content-center');
        $('#pointPagination .pagination .page-link').addClass('bg-transparent border-0 d-inline p-0 ms-2 me-2'); 
        $('#pointPagination .pagination .page-item:first-child .page-link').removeClass('border-0 p-0 ms-2 me-2').addClass('rounded-circle')
        .addClass('left').text('').append(`<img src="{{asset('assets/web/assets/img/account_order/left_1.png')}}" alt="">`);
        $('#pointPagination .pagination .page-item:last-child .page-link').removeClass('border-0 p-0 ms-2 me-2').addClass('rounded-circle')
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
    });
</script>
@endpush