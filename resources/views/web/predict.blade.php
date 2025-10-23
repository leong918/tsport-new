@extends('web.layout.app')

@section('body-class', 'bg-1')

@section('content')
    <div id="page-predict" class="screen">
        <!-- Characters Hero Section -->
        <section id="section-characters-hero">
            <div class="characters-background">
                <!-- Background elements similar to the attachments -->
                <div class="background-elements">
                    <div class="calendar-stamp">
                        <img src="{{ asset('assets/web/images/predict/element-1.png') }}" alt="calendar stamp"
                            onerror="this.style.display='none'" class="img-fluid">
                    </div>
                    <div class="kitchen-scene">
                        <img src="{{ asset('assets/web/images/predict/element-2.png') }}" alt="kitchen scene"
                            onerror="this.style.display='none'" class="img-fluid">
                    </div>
                </div>

                <!-- Speech Bubble -->
                <div class="speech-bubble">
                    <img src="{{ asset('assets/web/images/predict/chatbox-1.png') }}" alt="Speech Bubble"
                        class="speech-bubble-image">
                    <div class="bubble-content">
                        <p class="p2" id="bubbleText">球停停車，實時停球時，預測他一樣，實收早場才能靠大錢！</p>
                    </div>
                </div>

                <!-- Main Characters Display -->
                <div class="characters-showcase">
                    <div class="characters-row">
                        <div class="character-expert active" data-expert="Expert1" data-tab="ip1">
                            <div class="character-avatar character-left">
                                <img src="{{ asset('assets/web/images/predict/ip-active-1.png') }}" alt="IP 1" class="img-fluid">
                            </div>
                        </div>

                        <div class="character-expert" data-expert="Expert2" data-tab="ip2">
                            <div class="character-avatar character-center">
                                <img src="{{ asset('assets/web/images/predict/ip-active-2.png') }}" alt="IP 2" class="img-fluid">
                            </div>
                        </div>

                        <div class="character-expert" data-expert="Expert3" data-tab="ip3">
                            <div class="character-avatar character-right">
                                <img src="{{ asset('assets/web/images/predict/ip-active-3.png') }}" alt="IP 3" class="img-fluid">
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>


        <!-- Predictions Cards Section -->
        <section id="section-predictions">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Match Prediction Cards similar to matches design -->
                        @if ($formattedPredictions->count() > 0)
                            <div class="predictions-container">
                                @foreach ($formattedPredictions as $prediction)
                                    <div class="prediction-match-card"
                                        data-character="{{ $prediction['character_name'] }}">
                                        
                                        <!-- Prediction Image (if uploaded) -->
                                        @if (!empty($prediction['image']))
                                            <div class="prediction-image-container">
                                                <a href="{{ route('web.predict.detail', ['id' => $prediction['id']]) }}" class="prediction-image-link">
                                                    <img src="{{ $prediction['image'] }}" 
                                                         alt="Prediction by {{ $prediction['character_name'] }}" 
                                                         class="img-fluid">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="pagination-section">
                                {{ $predictions->links('web.pagination.custom') }}
                            </div>
                        @else
                            <div class="no-predictions">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <h3>暫無預測</h3>
                                    <p>專家們正在分析比賽，請稍後再來查看最新預測</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
