@extends('web.layout.app')

@section('content')
    <div id="page-matches" class="screen">
        <!-- title -->
        <section id="section-title">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <img src="{{ asset('assets/web/images/matches/title.png') }}" class="img-fluid" alt="Live Matches Title">
                    </div>
                </div>
            </div>
        </section>
        <!-- swiper section -->
        <section id="section-matches">
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
                                <p class="text-muted">暫無熱門比賽</p>
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
                            <img src="{{ asset('assets/web/images/matches/ads-banner.png') }}" class="img-fluid" alt="Banner">
                        </div>
                    </div>

                    @forelse($contentMatches as $match)
                        <div class="col">
                            <x-match-item :match="$match" />
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-4">
                                <p class="text-muted">暫無其他比賽數據</p>
                            </div>
                        </div>
                    @endforelse

                    @if($contentMatches->hasPages())
                        <div class="col-12">
                            <!-- pagination -->
                            <nav aria-label="比賽分頁導航">
                                {{ $contentMatches->links('web.pagination.custom') }}
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
