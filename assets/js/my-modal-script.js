jQuery(document).ready(function($) {
    // Open the modal when the button is clicked
    $('.my-modal-trigger').on('click', function() {
        $('#my-modal').fadeIn();
    });

    // Close the modal when the close button or outside the modal is clicked
    $('.my-modal-close, .my-modal').on('click', function(e) {
        if (e.target === this) {
            $('#my-modal').fadeOut();
        }
    });
});
