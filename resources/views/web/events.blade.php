@extends('web.layout.app')

@section('body-class', 'bg-2')

@section('content')
    <div id="page-events" class="screen">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="title-img">
                        <img src="{{ asset('assets/web/images/events/title.png') }}" alt="Events" class="img-fluid" />
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 g-4">
                @if (isset($events) && count($events) > 0)
                    @foreach ($events as $event)
                        <div class="col">
                            <x-event-card :eventId="$event['id']" :title="$event['title']" :timer="$event['timer']" :image="$event['image']" />
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
