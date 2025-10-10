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
                        <p class="p2" id="bubbleText">球停停车，实时停球时，预测他一样，实收早场才能靠大钱！</p>
                    </div>
                </div>

                <!-- Main Characters Display -->
                <div class="characters-showcase">
                    <div class="characters-row">
                        <div class="character-expert active">
                            <div class="character-avatar character-left">
                                <img src="{{ asset('assets/web/images/predict/ip-active-1.png') }}" alt="IP 1" class="img-fluid">
                            </div>
                        </div>

                        <div class="character-expert ">
                            <div class="character-avatar character-center">
                                <img src="{{ asset('assets/web/images/predict/ip-active-2.png') }}" alt="IP 2" class="img-fluid">
                            </div>
                        </div>

                        <div class="character-expert">
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
                        <!-- Match Prediction Cards similar to live-matches design -->
                        @if ($formattedPredictions->count() > 0)
                            <div class="predictions-container">
                                @foreach ($formattedPredictions as $prediction)
                                    <div class="prediction-match-card"
                                        data-character="{{ $prediction['character_name'] }}">
                                        
                                        <!-- Prediction Image (if uploaded) -->
                                        @if (!empty($prediction['image']))
                                            <div class="prediction-image-container">
                                                <a href="{{ route('web.predict.detail', ['id' => $prediction['id']]) }}" class="prediction-image-link">
                                                    <img src="{{ asset('storage/' . $prediction['image']) }}" 
                                                         alt="Prediction by {{ $prediction['character_name'] }}" 
                                                         class="prediction-box-image">
                                                </a>
                                            </div>
                                        @else
                                            <!-- Fallback to default card design if no image -->
                                            <div class="match-card-wrapper">
                                                <a href="{{ route('web.predict.detail', ['id' => $prediction['id']]) }}" class="prediction-card-link">
                                                    <!-- Character Badge -->
                                                    <div class="character-badge">
                                                        <span class="expert-name">{{ $prediction['character_display_name'] ?? $prediction['character_name'] }}</span>
                                                        <span class="prediction-type">小組賽</span>
                                                    </div>

                                                    <!-- Match Info Card -->
                                                    <div class="match-info-card">
                                                        @if ($prediction['match'])
                                                            <!-- Date and Time -->
                                                            <div class="match-datetime">
                                                                @if ($prediction['match']['start_at'])
                                                                    @php
                                                                        $matchDate = \Carbon\Carbon::parse(
                                                                            $prediction['match']['start_at'],
                                                                        );
                                                                    @endphp
                                                                    <span class="match-date">{{ $matchDate->format('d M Y') }}</span>
                                                                    <span class="match-time">{{ $matchDate->format('H:i') }}am</span>
                                                                @else
                                                                    <span class="match-date">TBD</span>
                                                                    <span class="match-time">TBD</span>
                                                                @endif
                                                            </div>

                                                            <!-- Teams Section -->
                                                            <div class="teams-section">
                                                                <!-- Team logos would be extracted from match title or separate fields -->
                                                                <div class="team home-team">
                                                                    <div class="team-logo">
                                                                        <!-- Dynamic team logo based on match title -->
                                                                        @php
                                                                            $teams = explode(' vs ', $prediction['match']['title']);
                                                                            $homeTeam = trim($teams[0] ?? 'Home');
                                                                            $awayTeam = trim($teams[1] ?? 'Away');
                                                                        @endphp
                                                                        <img src="{{ asset('assets/web/images/teams/' . strtolower(str_replace(' ', '-', $homeTeam)) . '.png') }}"
                                                                            alt="{{ $homeTeam }}"
                                                                            onerror="this.src='{{ asset('assets/web/images/teams/default-logo.png') }}'">
                                                                    </div>
                                                                    <span class="team-name">{{ $homeTeam }}</span>
                                                                </div>

                                                                <div class="vs-divider">VS</div>

                                                                <div class="team away-team">
                                                                    <div class="team-logo">
                                                                        <img src="{{ asset('assets/web/images/teams/' . strtolower(str_replace(' ', '-', $awayTeam)) . '.png') }}"
                                                                            alt="{{ $awayTeam }}"
                                                                            onerror="this.src='{{ asset('assets/web/images/teams/default-logo.png') }}'">
                                                                    </div>
                                                                    <span class="team-name">{{ $awayTeam }}</span>
                                                                </div>
                                                            </div>

                                                            <!-- Group/League Info -->
                                                            @if ($prediction['match']['short_content'])
                                                                <div class="group-info">
                                                                    <span class="group-label">{{ $prediction['match']['short_content'] }}</span>
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div class="no-match-info">
                                                                <span class="general-prediction">专家综合预测</span>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- Prediction Content -->
                                                    <div class="prediction-content">
                                                        <div class="prediction-text">
                                                            <p>{{ $prediction['description'] }}</p>
                                                        </div>

                                                        <!-- Interaction Stats -->
                                                        <div class="prediction-stats">
                                                            <div class="stat-item">
                                                                <i class="fas fa-heart"></i>
                                                                <span>{{ $prediction['likes_count'] }}</span>
                                                            </div>
                                                            <div class="stat-item">
                                                                <i class="fas fa-comment"></i>
                                                                <span>{{ $prediction['comments_count'] }}</span>
                                                            </div>
                                                            <div class="stat-item">
                                                                <i class="fas fa-clock"></i>
                                                                <span>{{ $prediction['created_at'] }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                    <h3>暂无预测</h3>
                                    <p>专家们正在分析比赛，请稍后再来查看最新预测</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
