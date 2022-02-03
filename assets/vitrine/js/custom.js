import {Carousel} from "bootstrap";

(function ($) {

  "use strict";

  // Banner Carousel
  let myCarousel = document.querySelector('#myCarousel')
  if (myCarousel) {
    new Carousel(myCarousel, {
      interval: 2500,
    })

  }

  // REVIEWS NAVIGATION
  function ReviewsNavResize() {
    var ReviewsOwlItem = $('.reviews-carousel .owl-item').width();
    $('.reviews-carousel .owl-nav').css({'width': (ReviewsOwlItem) + 'px'});
  }

  $(window).on("resize", ReviewsNavResize);
  $(document).on("ready", ReviewsNavResize);


})(window.jQuery);
