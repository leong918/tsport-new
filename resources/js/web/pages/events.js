/**
 * Events Page JavaScript
 * Handles events page specific functionality
 */

import $ from 'jquery';
import BasePage from './BasePage.js';

class EventsPage extends BasePage {
    constructor() {
        super();
        this.pageName = 'events';
        this.pageSelector = '#pages-events';
        
        // Auto-initialize if page elements are present
        if (this.shouldInitialize()) {
            this.init();
        }
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        // Event card click handlers
        $(document).on('click', '.event-card', (e) => {
            const eventId = $(e.currentTarget).data('event-id');
            this.openEvent(eventId);
        });

        // Bottom navigation active state
        $(document).on('click', '.nav-item', (e) => {
            e.preventDefault();
            $('.nav-item').removeClass('active');
            $(e.currentTarget).addClass('active');
        });
    }

    /**
     * Setup visual effects and animations
     */
    setupEffects() {
        // Add hover effects to event cards
        $('.event-card').hover(
            function() {
                $(this).css('transform', 'translateY(-5px)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
            }
        );
    }

    /**
     * Open event details
     */
    openEvent(eventId) {
        console.log('Opening event:', eventId);
        // Add your event opening logic here
        // This could navigate to a detailed event page
        
        // Example: redirect to event detail page
        // window.location.href = `/event/${eventId}`;
    }
}

// Auto-initialize if page elements are present
if ($('#pages-events').length) {
    new EventsPage();
}

export default EventsPage;
