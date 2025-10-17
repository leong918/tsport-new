@extends('web.layout.app')

@section('content')
    <div id="ordering" class="screen">
        {{-- Header Section --}}
        <div class="ordering-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header-content text-center">
                            <h1 class="page-title">點單區</h1>
                            <p class="page-subtitle">專業推薦，精準預測</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categories Section --}}
        <div class="categories-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="categories-wrapper">
                            @foreach($categories as $category)
                                <div class="category-card" data-category="{{ $category['id'] }}">
                                    <div class="category-icon">
                                        <div class="wooden-sign">
                                            <span class="category-text">{{ $category['name'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recommendations Section --}}
        <div class="recommendations-section">
            <div class="container">
                <div class="row">
                    @foreach($recommendations as $recommendation)
                        <div class="col-md-4 mb-4">
                            <div class="recommendation-card">
                                <div class="wooden-plate">
                                    <div class="plate-content">
                                        <div class="expert-avatar">
                                            <img src="{{ $recommendation['avatar'] ?? asset('assets/web/images/global/logo.png') }}" 
                                                 class="img-fluid" alt="{{ $recommendation['expert'] }}">
                                        </div>
                                        
                                        <div class="expert-name">{{ $recommendation['expert'] }}</div>
                                        
                                        <div class="recommendation-title">{{ $recommendation['title'] }}</div>
                                        
                                        <div class="recommendation-desc">{{ $recommendation['description'] }}</div>
                                        
                                        @if($recommendation['badge'])
                                            <div class="recommendation-badge badge-{{ $recommendation['badge'] }}">
                                                @switch($recommendation['badge'])
                                                    @case('hot')
                                                        熱門
                                                        @break
                                                    @case('recommended')
                                                        推薦
                                                        @break
                                                    @case('special')
                                                        特別
                                                        @break
                                                @endswitch
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Chef Character Section --}}
        <div class="chef-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="chef-wrapper text-center">
                            <div class="chef-character">
                                <div class="chef-placeholder">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="chef-speech-bubble">
                                    <p>老闆，今天想吃什麼好料？</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Items Grid Section --}}
        <div class="items-section" id="items-section">
            <div class="container">
                @foreach($categories as $category)
                    <div class="category-items" data-category="{{ $category['id'] }}" style="display: none;">
                        <h3 class="category-title">{{ $category['name'] }}類推薦</h3>
                        <div class="row">
                            @foreach($category['items'] as $item)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="item-card">
                                        <div class="item-image">
                                            @if($item['image'])
                                                <img src="{{ $item['image'] }}" class="img-fluid" alt="{{ $item['name'] }}">
                                            @else
                                                <div class="item-placeholder">
                                                    <i class="fas fa-utensils"></i>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="item-content">
                                            <h4 class="item-name">{{ $item['name'] }}</h4>
                                            <p class="item-description">{{ $item['description'] }}</p>
                                            <div class="item-price">¥{{ number_format($item['price'], 2) }}</div>
                                            
                                            <button class="btn btn-primary add-to-cart-btn" 
                                                    data-item-id="{{ $item['id'] }}"
                                                    data-item-name="{{ $item['name'] }}"
                                                    data-item-price="{{ $item['price'] }}">
                                                加入購物車
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- View All Button --}}
        <div class="view-all-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <button class="btn btn-view-all" id="view-all-btn">
                            <span>查看全部</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cart Sidebar --}}
        <div class="cart-sidebar" id="cart-sidebar">
            <div class="cart-header">
                <h4>購物車</h4>
                <button class="cart-close" id="cart-close">&times;</button>
            </div>
            
            <div class="cart-items" id="cart-items">
                <p class="empty-cart">購物車為空</p>
            </div>
            
            <div class="cart-footer">
                <div class="cart-total">
                    <span>總計: ¥<span id="cart-total">0.00</span></span>
                </div>
                <button class="btn btn-primary btn-checkout" id="checkout-btn">
                    結算
                </button>
            </div>
        </div>

        {{-- Cart Toggle Button --}}
        <div class="cart-toggle" id="cart-toggle">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count" id="cart-count">0</span>
        </div>
    </div>
@endsection
