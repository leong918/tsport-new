@extends('web.layout.app')

@section('content')
    <div id="page-live-matches" class="screen">
        <!-- title -->
        <section id="section-title">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <img src="{{ asset('assets/web/images/live-matches/title.png') }}" class="img-fluid" alt="Live Matches Title">
                    </div>
                </div>
            </div>
        </section>
        <!-- swiper section -->
        <section id="section-live-matches">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if(!empty($swiperMatches))
                            <div class="swiper" id="matchesSwiper">
                                <div class="swiper-wrapper">
                                    @foreach($swiperMatches as $match)
                                        <x-match-slide :match="$match" />
                                    @endforeach
                                </div>

                                <!-- Navigation arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>

                            <div class="swiper__info" id="matchesSwiperInfo">
                                <!-- need to add content here -->
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-muted">暂无热门比赛</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Content -->
        <section id="section-matches-list">
            <div class="container">
                <div class="row row-cols-2 g-3">
                    <!-- ads banner -->
                    <div class="col-12">
                        <div class="banner">
                            <img src="{{ asset('assets/web/images/live-matches/ads-banner.png') }}" class="img-fluid" alt="Banner">
                        </div>
                    </div>

                    @forelse($contentMatches as $match)
                        <div class="col">
                            <x-match-item :match="$match" />
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-4">
                                <p class="text-muted">暂无其他比赛数据</p>
                            </div>
                        </div>
                    @endforelse

                    @if($contentMatches->hasPages())
                        <div class="col-12">
                            <!-- pagination -->
                            <nav aria-label="比赛分页导航">
                                {{ $contentMatches->links('web.pagination.custom') }}
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
