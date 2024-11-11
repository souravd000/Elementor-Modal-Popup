jQuery(document).ready(function($) {
    // Open the specific modal when the associated button is clicked
    $('.my-modal-trigger').on('click', function() {
        var modalId = $(this).data('modal');
        $(modalId).fadeIn();
    });

    // Close the modal when the close button or outside the modal content is clicked
    $('.my-modal').on('click', function(e) {
        if ($(e.target).is('.my-modal, .my-modal-close')) {
            $(this).fadeOut();
        }
    });
});
