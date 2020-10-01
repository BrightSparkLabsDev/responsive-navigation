(function($) {
console.log("ready");
    $(document).on("click", '.wpfpm-trigger', function() {
        console.log("triggered");
        if($('.wpfpm').hasClass('open')) {
            $('.wpfpm').slideToggle().removeClass('open');
            $('.header-bar').removeClass('active');
        } else {
            $('.wpfpm').slideToggle().addClass('open');
            $('.header-bar').addClass('active');
        }
    });
    

})( jQuery );