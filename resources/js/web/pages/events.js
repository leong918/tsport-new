import $ from 'jquery';

if ($('#pages-events').length) {
    // Event interaction handlers
    $('.event-card').on('click', function() {
        const eventId = $(this).data('event-id');
        openEvent(eventId);
    });

    // Add hover effects
    $('.event-card').hover(
        function() {
            $(this).css('transform', 'translateY(-5px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );

    // Bottom navigation active state
    $('.nav-item').on('click', function(e) {
        e.preventDefault();
        $('.nav-item').removeClass('active');
        $(this).addClass('active');
    });
}

function openEvent(eventId) {
    console.log('Opening event:', eventId);
    // Add your event opening logic here
    // This could navigate to a detailed event page
    window.location.href = `/events/${eventId}`;
}

// Export for global use
window.openEvent = openEvent;
