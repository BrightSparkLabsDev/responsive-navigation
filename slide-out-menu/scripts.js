(function($) {
    $(document).on("touchend click", '.wpslm-trigger', function() {
      $('.wpslm').addClass('open');
    });
    $(document).on("click", '.wpslm-right:not(.open)', function() {
      $('.wpslm').addClass('open');
    });

    $(document).on("touchend click", '.wpslm-close', function() {
      $('.wpslm').removeClass('open');
    });
})(jQuery);
