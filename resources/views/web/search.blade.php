<div class="search-wrapper collapse" id="nav-search-toggle">
    {{ html()->form()->acceptsFiles()->id('')->open()  }}
        <div>
            {{ html()->email('keyword')->placeholder('Search')->class('')->required() }}
        </div>
    {{ html()->form()->close() }}
    <div class="cross-to-close">
        <img src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}" alt="">
    </div>
</div>