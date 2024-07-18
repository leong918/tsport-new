@extends('web.layout.app')
@section('content')
<div id="event-details">
    <div class="content-section">
        <div class="event-detail-container">
            <div class="breadcrumb-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item p4"><a href="{{ route('web.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item p4"><a href="{{ route('web.event') }}">{{ __('News & Events') }}</a></li>
                        <li class="breadcrumb-item active p4" aria-current="page">Hello Smile HK x Faith in Love Foundation</li>
                    </ol>
                </nav>
            </div>

            <div class="date-container">
                <p>2024/04/01</p>
            </div>
            <div class="name-container">
                <p>Hello Smile HK x Faith in Love Foundation</p>
            </div>

            <div class="row event-img-list-container">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/1.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/1.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/2.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/2.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/3.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/3.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/4.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/4.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/5.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/5.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/6.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/6.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/7.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/7.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/8.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/8.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/9.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/9.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/10.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/10.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/11.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/11.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ asset('assets/web/assets/img/event-details/12.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ asset('assets/web/assets/img/event-details/12.png') }}" alt="" />
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Image Start --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="modalImage" alt="image" class="img-fluid">
                    <button type="button" class="close close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/web/assets/img/event-details/close-icon.png') }}" />
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Image End --}}
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.event-img').click(function() {
            var imageSrc = $(this).attr('data-image');
            $('#modalImage').attr('src', imageSrc);
        });
    });
</script>
@endpush