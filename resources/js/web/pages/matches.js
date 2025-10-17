/**
 * Live Matches Page JavaScript
 * Handles live matches swiper functionality
 */

import $ from 'jquery';
import Swiper from 'swiper';
import { Autoplay, EffectCoverflow, Navigation } from 'swiper/modules';
import BasePage from './BasePage.js';

class LiveMatchesPage extends BasePage {
    constructor() {
        super();
        this.pageName = 'matches';
        this.pageSelector = 'section#section-matches';
        this.swiper = null;
        
        // Auto-initialize if page elements are present
        if (this.shouldInitialize()) {
            this.init();
        }
    }

    /**
     * Initialize swiper
     */
    initSwiper() {
        if (!$('#matchesSwiper').length) return;

        this.swiper = new Swiper('#matchesSwiper', {
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
                init: (swiper) => {
                    this.updateButtonImages(swiper);
                    this.updateSlideEffects(swiper);
                    this.updateSlideInfo(swiper);
                },
                slideChange: (swiper) => {
                    this.updateButtonImages(swiper);
                    this.updateSlideEffects(swiper);
                    this.updateSlideInfo(swiper);
                }
            }
        });
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        // Any additional event listeners can be added here
    }

    /**
     * Setup visual effects and animations
     */
    setupEffects() {
        // Remove swiper navigation icons/SVG elements
        $('.swiper-navigation-icon').remove();
        $('.swiper-button-next svg, .swiper-button-prev svg').remove();
        $('.swiper-button-next .swiper-navigation-icon, .swiper-button-prev .swiper-navigation-icon').remove();

        // Remove overflow hidden on swiper container
        $('#matchesSwiper').css('overflow', 'visible');
        $('#section-matches').css('overflow', 'visible');
    }

    /**
     * Override init to include swiper initialization
     */
    init() {
        super.init();
        this.initSwiper();
    }

    /**
     * Update button images based on swiper state
     */
    updateButtonImages(swiperInstance) {
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

    /**
     * Update slide grayscale effects
     */
    updateSlideEffects(swiperInstance) {
        // Remove grayscale from all slides first
        $(swiperInstance.slides).find('img').css('filter', 'grayscale(100%)');
        
        // Remove grayscale from active slide only
        $(swiperInstance.slides[swiperInstance.activeIndex]).find('img').css('filter', 'grayscale(0%)');
    }

    /**
     * Update external slide info
     */
    updateSlideInfo(swiperInstance) {
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
}

// Auto-initialize if page elements are present
if ($('section#section-matches').length && $('#matchesSwiper').length) {
    new LiveMatchesPage();
}

export default LiveMatchesPage;
