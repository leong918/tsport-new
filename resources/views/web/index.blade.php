@extends('web.layout.app')

@section('content')
    <div id="page-home" class="screen">
        <!-- Example 1: Simple Horizontal Scroll Section -->
        <section class="horizontal-section py-5">
            <div class="container-fluid">
                <h2 class="text-center mb-4">Horizontal Scroll Gallery</h2>
                <div class="horizontal-scroll-wrapper">
                    @for ($i = 1; $i <= 10; $i++)
                        <div class="scroll-card">
                            <div class="card-image">
                                <img src="{{ asset('assets/web/images/sample.png') }}" alt="Image {{ $i }}">
                            </div>
                            <h3 class="card-title">Card {{ $i }}</h3>
                            <p class="card-text">This is a horizontally scrolling card with smooth GSAP animations.</p>
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- Example 2: Gallery Section with Snap -->
        <section class="gallery-section">
            <div class="container-fluid">
                <h2 class="text-center mb-4">Image Gallery</h2>
                <div class="gallery-wrapper">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="gallery-item">
                            <img src="{{ asset('assets/web/images/sample.png') }}" alt="Gallery {{ $i }}">
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- Regular vertical content -->
        <section class="py-5">
            <div class="container">
                <h2 class="text-center">Regular Vertical Section</h2>
                <p class="text-center">This section scrolls normally while the sections above scroll horizontally.</p>
            </div>
        </section>
    </div>
@endsection
