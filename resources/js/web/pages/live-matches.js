import $ from 'jquery';
import Swiper from 'swiper';
import { Autoplay, EffectCoverflow, Navigation } from 'swiper/modules';

if ($('section#section-live-matches').length && $('#matchesSwiper').length) {
    const swiper = new Swiper('#matchesSwiper', {
        modules: [Autoplay, Navigation, EffectCoverflow],
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        initialSlide: 1,
        slidesPerView: 1.1,
        spaceBetween: 30,
        centeredSlides: true,
        effect: 'coverflow',
        coverflowEffect: {
            rotate: 0,
            stretch: -5,
            depth: 50,
            modifier: 2.5,
            slideShadows: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            init: function() {
                // Set custom button images
                updateButtonImages(this);
                // Update slide grayscale effects
                updateSlideEffects(this);
                // Show slide info for active slide
                updateSlideInfo(this);
            },
            slideChange: function() {
                // Update button images on slide change
                updateButtonImages(this);
                // Update slide grayscale effects
                updateSlideEffects(this);
                // Show slide info for active slide
                updateSlideInfo(this);
            }
        }
    });

    // Function to update button images based on state
    function updateButtonImages(swiperInstance) {
        const nextBtn = $('.swiper-button-next');
        const prevBtn = $('.swiper-button-prev');
        
        // Update next button
        if (swiperInstance.isEnd && !swiperInstance.params.loop) {
            nextBtn.css('background-image', 'url(/assets/web/images/swiper/button-next-unavailable.png)');
        } else {
            nextBtn.css('background-image', 'url(/assets/web/images/swiper/button-next-available.png)');
        }
        
        // Update prev button
        if (swiperInstance.isBeginning && !swiperInstance.params.loop) {
            prevBtn.css('background-image', 'url(/assets/web/images/swiper/button-prev-unavailable.png)');
        } else {
            prevBtn.css('background-image', 'url(/assets/web/images/swiper/button-prev-available.png)');
        }
    }

    // Function to update slide grayscale effects
    function updateSlideEffects(swiperInstance) {
        // Remove grayscale from all slides first
        $(swiperInstance.slides).find('img').css('filter', 'grayscale(100%)');
        
        // Remove grayscale from active slide only
        $(swiperInstance.slides[swiperInstance.activeIndex]).find('img').css('filter', 'grayscale(0%)');
    }

    // Function to update external slide info
    function updateSlideInfo(swiperInstance) {
        const activeSlide = $(swiperInstance.slides[swiperInstance.activeIndex]);
        const infoContainer = $('#matchesSwiperInfo');
        
        // Get data from active slide
        const title = activeSlide.data('title');
        const league = activeSlide.data('league');
        const status = activeSlide.data('status');
        
        // Build the info HTML
        let infoHtml = '<div class="slide__info">';
        infoHtml += '<div class="match-details">';
        infoHtml += `<h4 class="match-teams">${title}</h4>`;
        infoHtml += `<p class="match-league p2 text-gray-medium">${league}</p>`;
        infoHtml += '</div>';
        
        if (status) {
            infoHtml += '<div class="match-status">';
            infoHtml += `<p class="p1">${status}</p>`;
            infoHtml += '</div>';
        }
        
        infoHtml += '</div>';
        
        // Update the external info container
        infoContainer.html(infoHtml);
    }

    // Remove swiper navigation icons/SVG elements
    $('.swiper-navigation-icon').remove();
    $('.swiper-button-next svg, .swiper-button-prev svg').remove();
    $('.swiper-button-next .swiper-navigation-icon, .swiper-button-prev .swiper-navigation-icon').remove();

    // remove overflow hidden on swiper container
    $('#matchesSwiper').css('overflow', 'visible');
    $('#section-live-matches').css('overflow', 'visible');
}
