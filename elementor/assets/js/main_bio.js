(function($){

    'use strict';

    // Popup Search
    $('body').on('click', '.popup-search-opener', function (e) {
        e.stopPropagation();
        $(this).closest('.popup-search-wrapper').find('.popup-search').addClass('open');
    });

    $('.popup-search-container').on('click', function (e) {
        e.stopPropagation();
    });

    $('body, .popup-search-closer').on('click', function (e) {
        $('.popup-search').removeClass('open');
    } );
    
    // Single Post Share Link Box
    $(".share-box-link .share-link-btn").on('click', function(){
        // Get the text to copy
        var textToCopy = $(".share-box-link .share-link-text").val();

        // Create a temporary input element
        var tempInput = document.createElement("input");
        tempInput.style.position = "absolute";
        tempInput.style.left = "-9999px"; // Move off-screen
        tempInput.value = textToCopy;

        // Append the input element to the body
        document.body.appendChild(tempInput);

        // Select the input element's value
        tempInput.select();

        // Execute the copy command
        document.execCommand('copy');

        // Remove the temporary input element
        document.body.removeChild(tempInput);

        // Show copied popup text
        $('.share-box-link .copied-popup-text').addClass('show');
        setTimeout(function () {
            $('.share-box-link .copied-popup-text').removeClass('show');
        }, 2000);
    } );
    
})( jQuery );
