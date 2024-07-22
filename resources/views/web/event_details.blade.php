@extends('web.layout.app')
@section('content')
<div id="event-details">
    <div class="content-section">
        <div class="event-detail-container">
            <div class="breadcrumb-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item p4"><a href="{{ route('web.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item p4"><a href="{{ route('web.event') }}">{{ __(App\Models\Event::TYPE[$event['type']]) }}</a></li>
                        <li class="breadcrumb-item active p4" aria-current="page">{{ $event['name'] }}</li>
                    </ol>
                </nav>
            </div>

            <div class="date-container">
                <p class="p3">{{ $event['date'] }}</p>
            </div>
            <div class="name-container">
                <h3 class="h3">{{ $event['name'] }}</h3>
            </div>

            <div class="row event-img-list-container">
                @foreach($images as $image)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-img" data-image="{{ $image }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <img src="{{ $image }}" alt="" />
                    </div>
                </div>
                @endforeach
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