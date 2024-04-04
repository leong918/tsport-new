@extends('web.layout.app')
@section('content')
<section id="about-point" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{$setting_model['faq_banner']}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Points To Cash Programme</div>
            <div class="nav-acc"><a href="{{route('web.home')}}">Home</a> > <a href="{{route('about.index')}}"> About</a> > <a href="{{route('about.points')}}"> Point To Cash Programme</a></div>
        </div>
    </div>
    <div class="about-content">
        <div class="container">
            <div class="row row-about-content">
                <div class="col-12">
                    <div class="text-center title-about-membership">
                        積分優惠計劃<br/>
                        Points to Cash Programme
                    </div>
                </div>
                <div class="accordion" id="accordionExample">
                    @foreach ($faq_model->where('status', 1) as $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq_{{$faq->id}}" aria-expanded="false" aria-controls="faq_{{$faq->id}}">
                            <div class="qna-title">
                                <div class="q-icon">
                                    <span>Q</span>
                                </div>
                                <div class="q-txt">
                                    {!! $faq->question !!}
                                </div>
                            </div>
                        </button>
                        </h2>
                        <div id="faq_{{$faq->id}}" class="accordion-collapse accordion-unity collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="qna-ans">
                                <div class="a-icon">
                                        <span>A</span>
                                    </div>
                                    <div class="q-txt">
                                        {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $('.accordion-item').on('click', function() {
        $('.accordion-item').css('box-shadow', 'unset');
        if (!($(this).find('.accordion-button').hasClass('collapsed'))) {
            $(this).css('box-shadow', '0px 0px 5px rgba(0, 0, 0, 0.3)');
        }
    });
</script>
@endpush