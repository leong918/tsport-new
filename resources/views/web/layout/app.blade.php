<!DOCTYPE html>
<html lang="sc">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Display Boilerplate">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>T Power Sport</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}" />
    @vite(['resources/scss/web/app.scss', 'resources/js/web/app.js'])
    @stack('styles')
</head>

<body id="app" class="@yield('body-class', 'bg-1')">
    {{-- Header outside ScrollSmoother to ensure it's always visible --}}
    @if(Route::currentRouteName() != 'web.ordering')
    @include('web.layout.header')
    @endif

    <div id="smooth-wrapper">
        <div id="smooth-content">
            @yield('content')
            
            @if(Route::currentRouteName() != 'web.ordering')
            @include('web.layout.footer')
            @endif
        </div>
    </div>
    @stack('fixed-bottom')
    @stack('modals')
    @stack('scripts')
    
    <script>
        // Auto-detect fixed bottom elements and apply appropriate padding
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.body;
            
            // Check for various types of fixed bottom elements
            function updateBottomPadding() {
                // Remove existing padding classes
                body.classList.remove('has-fixed-bottom', 'has-comment-input', 'has-navigation-bar', 'has-action-bar', 'has-player-controls');
                
                // Check for specific fixed bottom elements
                if (document.querySelector('#section-input-comment, .comment-input-section')) {
                    body.classList.add('has-comment-input');
                } else if (document.querySelector('.bottom-navigation, .navbar-bottom')) {
                    body.classList.add('has-navigation-bar');
                } else if (document.querySelector('.action-buttons-fixed, .fixed-action-bar')) {
                    body.classList.add('has-action-bar');
                } else if (document.querySelector('.player-controls-fixed, .media-controls-bottom')) {
                    body.classList.add('has-player-controls');
                } else if (document.querySelector('.fixed-bottom')) {
                    body.classList.add('has-fixed-bottom');
                }
            }
            
            // Initial check
            updateBottomPadding();
            
            // Re-check when new elements are added (for dynamic content)
            const observer = new MutationObserver(function(mutations) {
                let shouldUpdate = false;
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList') {
                        mutation.addedNodes.forEach(function(node) {
                            if (node.nodeType === 1) { // Element node
                                if (node.classList && (
                                    node.classList.contains('fixed-bottom') ||
                                    node.classList.contains('comment-input-section') ||
                                    node.classList.contains('bottom-navigation') ||
                                    node.classList.contains('action-buttons-fixed') ||
                                    node.id === 'section-input-comment'
                                )) {
                                    shouldUpdate = true;
                                }
                            }
                        });
                    }
                });
                
                if (shouldUpdate) {
                    setTimeout(updateBottomPadding, 100);
                }
            });
            
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        });
    </script>
</body>

</html>
