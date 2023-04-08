/**
 * Name file:   hightlight_day
 * Description: use jQuery to highlight the opening day of the restaurant
 *
 * Version: 1.0
 * Author: Enza Lombardo
 */

(function($){

  $(document).ready(function() {
    $('.table-horaire tr').eq(new Date().getDay()-1).addClass('today');
  });

})(jQuery);
