<div id="search-navbar">
    <div class="search-wrapper collapse" id="nav-search-toggle">
        <div>
            {{ html()->form('GET', route("web.product"))->id('search')->open()  }}
                <div class="search-inner">
                    {{ html()->text('search_keyword')->placeholder('Search')->class('')->required() }}
                    <div class="cross-to-close">
                        <img src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}" alt="">
                    </div>
                </div>

            {{ html()->form()->close() }}
        </div>
    </div>
</div>