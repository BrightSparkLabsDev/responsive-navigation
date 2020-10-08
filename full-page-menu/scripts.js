(function($) {
    $(document).on("click", '.wpfpm-trigger', function() {
        if($('.wpfpm').hasClass('open')) {
            $('.wpfpm').slideToggle().removeClass('open');
            $('.header-bar').removeClass('active');
        } else {
            $('.wpfpm').slideToggle().addClass('open');
            $('.header-bar').addClass('active');
        }
    });
})( jQuery );
