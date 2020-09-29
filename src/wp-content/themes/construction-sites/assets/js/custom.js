(function ($) {
  "use strict";

  var $main_window = $(window);

  /*====================================
  preloader js
  ======================================*/
  $main_window.on("load", function () {
    $(".preloader").fadeOut("slow");
  });

  /*====================================
  scroll to top js
  ======================================*/
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 250) {
      $("#c-scroll").fadeIn(200);
    } else {
      $("#c-scroll").fadeOut(200);
    }
  });
  $("#c-scroll").on("click", function () {
    $("html, body").animate({
        scrollTop: 0
      },
      "slow"
    );
    return false;
  });

  /*====================================
     sticky menu js
  ======================================*/

  $main_window.on('scroll', function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 200) {
      $(".affix").addClass("sticky-menu");
    } else {
      $(".affix").removeClass("sticky-menu");
    }
  });

  /*====================================
  toggle search
  ======================================*/
  $('.menu-search a').on("click", function () {
    $('.menu-search-form').toggleClass('s-active');
  });

  /*====================================
		main slider js
	======================================*/


  /*====================================
    programs-slider-one
  ======================================*/
  if ($(".programs-slider-one").length > 0) {
    var swiper = new Swiper('.programs-slider-one', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      slidesPerView: 5,
      paginationClickable: true,
      spaceBetween: 0,
      loop: true,
      centeredSlides: true,
      slideToClickedSlide: true,
      parallax: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      }, 
      autoplayDisableOnInteraction: false,
      effect: 'coverflow',
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 20,
        modifier: 1,
        slideShadows: false,
      },
      breakpoints: {
        992: {
          slidesPerView: 3,
        },
        576: {
          slidesPerView: 1,
        }
      }
    });
  }


  /*====================================
    blog one slider
  ======================================*/
  var teamslider = $(".blog-slider");
  teamslider.owlCarousel({
    margin: 30,
    autoplay: true,
    autoplayHoverPause: true,
    nav: false,
    smartSpeed: 1000,
    dots: true,
    loop: true,
    navText: [
      '<i class="fa fa-arrow-left"></i>',
      '<i class="fa fa-arrow-right"></i>'
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      768: {
        items: 2,
      },
      1199: {
        items: 3,
      }
    }
  });

  /*====================================
    Isotop And Masonry
  ======================================*/
  if ($(".masonary-wrap").length > 0) {
    $main_window.on('load', function () {
      var $grid = $('.masonary-wrap').isotope({
        itemSelector: '.mas-item',
        percentPosition: true,
        masonry: {
          columnWidth: '.mas-item'
        }
      });
      $('.sorting').on('click', '.filter-btn', function () {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
          filter: filterValue
        });
      });
      $('.sorting li').on('click', function (event) {
        $(".filter-btn").removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
      });
    });
  }

  /*====================================
     magnific popup
   ======================================*/
  if ($('.project').length > 0) {
    $('.project').magnificPopup({
      delegate: '.pop-btn',
      type: 'image',
      gallery: {
        enabled: true
      },
      removalDelay: 300,
      mainClass: 'mfp-fade'
    });
  }

  /*=======================================
     counter
  ======================================= */

  if ($('#counters').length > 0) {
    var a = 0;
    $main_window.scroll(function () {
      var oTop = $('#counters').offset().top - window.innerHeight;
      if (a === 0 && $main_window.scrollTop() > oTop) {
        $('.count').each(function () {
          var $this = $(this),
            countTo = $this.attr('data-count');
          $({
            countNum: $this.text()
          }).animate({
            countNum: countTo
          }, {
            duration: 3000,
            easing: 'swing',
            step: function () {
              $this.text(Math.floor(this.countNum));
            },
            complete: function () {
              $this.text(this.countNum);
              //alert('finished');
            }
          });
        });
        a = 1;
      }

    });
  }

  /*====================================
	 team-slider-two
	======================================*/

  var team2slider = $(".team-slider-two");
  team2slider.owlCarousel({
    autoplay: true,
    autoplayHoverPause: true,
    nav: true,
    smartSpeed: 1000,
    dots: false,
    loop: true,
    margin: 30,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>'
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      575: {
        items: 1,
      },
      991: {
        items: 2,
      }
    }
  });

  /*====================================
	  testimonial slider js
	======================================*/
 
 var owl_testi1 = jQuery(".testi-one-slider");
  owl_testi1.owlCarousel({
    loop: true,
    margin: 0,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    responsiveClass: true,
    items: 1,
    autoplay: true,
    autoplayHoverPause: false,
    nav: true,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>'
    ],
    dotsContainer: '#testi-custom-thumb',
  });


  /*====================================
		partner slider js
	======================================*/

  /*====================================
		service 3 slider js
	======================================*/


  /*====================================
		service 4 slider js
	======================================*/


  /*====================================
		class slider js
	======================================*/


  /*====================================
	  social sharing
	======================================*/
  if ($(".share").length > 0) {
    $(".share").jsSocials({
      showLabel: false,
      showCount: false,
      shareIn: "blank",
      shares: [{
          share: "twitter",
          logo: "fa fa-twitter-square",
        },
        {
          share: "facebook",
          logo: "fa fa-facebook-square"
        },
        {
          share: "googleplus",
          logo: "fa fa-google-plus-square"
        },
        {
          share: "linkedin",
          logo: "fa fa-linkedin-square"
        },
        {
          share: "pinterest",
          logo: "fa fa-pinterest-square"
        }
      ]
    });
  }


  /*======================================
    box mouse-enter hover
   ====================================== */
  var BoxHover = function () {
    jQuery('.box-hover').on('mouseenter', function () {
      jQuery(this).closest('.row').find('.box-hover').removeClass('active');
      jQuery(this).addClass('active');
    });
  };
  BoxHover();

  $(document).ready(function() {
      $(".main-menu").accessibleDropDown();
  });

  $.fn.accessibleDropDown = function () {
      var el = $(this);

      /* Make dropdown menus keyboard accessible */

      $("a", el).focus(function() {
          $(this).parents("li").addClass("on-focus");
      }).blur(function() {
          $(this).parents("li").removeClass("on-focus");
      });
  }

})(jQuery);