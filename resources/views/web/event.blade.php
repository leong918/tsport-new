    @extends('web.layout.app')
    @section('content')
    <div id="event">
        <div class="section-header">
            <div class="row gx-0 header-row">
                <div class="col-12 col-md-5 banner-background">
                    <div class="title">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item p4"><a href="{{ route('web.home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active p4" aria-current="page">{{ __('News & Events') }}</li>
                            </ol>
                        </nav>
                        <h2 class="h2">
                            {{ __('News & Events') }}
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-md-7 d-none d-md-block">
                    <img src="{{ asset('assets/web/assets/img/event/banner.png') }}" alt="" class="img img-fluid banner-img h-100">
                </div>
            </div>
        </div>
        <div class="content-section">
            <div class="container">
                <div class="event-category-tab-container">
                    <ul class="event-category-tab">
                        <li>
                            <a href="#" class="active filter-button" data-filter="*">{{ __('All') }}</a>
                        </li>
                        <li>
                            <a href="#" class="filter-button" data-filter=".news">{{ __('News') }}</a>
                        </li>
                        <li>
                            <a href="#" class="filter-button" data-filter=".event">{{ __('Events') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="row event-list-container align-items-stretch">
                    <!-- Event items go here -->
                    @foreach($events as $slug => $event)
                    <div class="col-lg-4 col-md-6 col-sm-12 event-container {{ $event['type'] }}">
                        <a href="{{ route('web.event_details', ['slug' => $slug]) }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="img-wrapper d-flex justify-content-center">
                                        <img src="{{ $event['banner'] }}" alt="" class="img img-fluid event-img">
                                    </div>
                                    <p class="p3">{{ $event['date'] }}</p>
                                    <h5 class="h5">{{ $event['name'] }}</h5>

                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="pagination-container">
                    <a href="#" id="event-prev">
                        <img src="{{ asset('assets/web/assets/img/event/pagination-prev-active.png') }}" alt="Previous" class="img img-fluid">
                    </a>
                    <ul>
                        <li><a href="#" class="active">1</a></li>
                    </ul>
                    <a href="#" id="event-next">
                        <img src="{{ asset('assets/web/assets/img/event/pagination-next-inactive.png') }}" alt="Next" class="img img-fluid">
                    </a>
                </div>
                
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
    <script>
        $(document).ready(function() {
            var $container = $('.event-list-container').isotope({
                itemSelector: '.event-container',
                layoutMode: 'fitRows'
            });

            var itemsPerPage = 9;
            var currentPage = 1;
            var currentFilter = getQueryString('type') || '*';
            var pageCount = 1;
            
            // Handle filter button clicks
            $('.filter-button').on('click', function(e) {
                e.preventDefault();
                $('.filter-button').removeClass('active');
                $(this).addClass('active');

                currentFilter = $(this).attr('data-filter'); // Update currentFilter

                //history.replaceState(null, '', url.pathname + url.search);

                // $container.isotope({ filter: currentFilter }); // Apply filter
                setPagination(currentFilter); // Update pagination based on the new filter
                goToPage(1); // Go to the first page
            });

            // Go to a specific page
            function goToPage(page) {
                currentPage = page;
                var selector = currentFilter + '.page' + currentPage;
                $container.isotope({ filter: selector });
                $('.pagination-container ul li a').removeClass('active');
                $('.pagination-container ul li a').eq(currentPage - 1).addClass('active');

                updateNavButtons();
            }

            // Set up pagination based on the filtered items
            function setPagination(currentFilter) {
                var $filteredItems = $('.event-container').filter(function() {
                    return $(this).is(currentFilter);
                });

                var itemCount = $filteredItems.length;

                pageCount = Math.ceil(itemCount / itemsPerPage);
                // Remove existing page classes
                $container.children('.event-container').removeClass(function(index, className) {
                    return (className.match(/(^|\s)page\S+/g) || []).join(' ');
                });

                // Add page classes to the filtered items
                $filteredItems.each(function(index) {
                    $(this).addClass('page' + Math.ceil((index + 1) / itemsPerPage));
                });

                // Create pagination links
                var pagination = '';
                for (var i = 1; i <= pageCount; i++) {
                    pagination += '<li><a href="#"' + (i === 1 ? ' class="active"' : '') + '>' + i + '</a></li>';
                }
                $('.pagination-container ul').html(pagination);

                // Bind click events to pagination links
                $('.pagination-container ul li a').on('click', function(e) {
                    e.preventDefault();
                    var page = parseInt($(this).text(), 10);
                    goToPage(page);
                });

                updateNavButtons();
            }

            function updateNavButtons() {
                if (currentPage === 1) {
                    $('#event-prev').find('img').attr('src', "{{ asset('assets/web/assets/img/event/pagination-prev-inactive.png') }}");
                    $('#event-prev').addClass('disabled');
                } else {
                    $('#event-prev').find('img').attr('src', "{{ asset('assets/web/assets/img/event/pagination-prev-active.png') }}");
                    $('#event-prev').removeClass('disabled');
                }

                if (currentPage === pageCount) {
                    $('#event-next').find('img').attr('src', "{{ asset('assets/web/assets/img/event/pagination-next-inactive.png') }}");
                    $('#event-next').addClass('disabled');
                } else {
                    $('#event-next').find('img').attr('src', "{{ asset('assets/web/assets/img/event/pagination-next-active.png') }}");
                    $('#event-next').removeClass('disabled');
                }
            }

            // Handle next page button click
            $('#event-next').on('click', function(e) {
                e.preventDefault();
                if (currentPage < pageCount) {
                    goToPage(currentPage + 1);
                }
            });

            // Handle prev page button click
            $('#event-prev').on('click', function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    goToPage(currentPage - 1);
                }
            });

            function getQueryString(name) {
                var queryString = new URLSearchParams(window.location.search);
                return queryString.get(name);
            }

            // Initialize pagination and set the first page
            setPagination(currentFilter);
            goToPage(1);
        });
    </script>


    @endpush