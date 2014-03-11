(function($){
  Drupal.behaviors.ou_digital_futures = {
    attach: function(context, settings) {
     $("#custom_id").accordion({
                autoHeight: false,
                clearStyle: true,
                animate: 150
              });
    }
  };
})(jQuery);        