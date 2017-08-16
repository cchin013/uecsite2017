jQuery(function ($) { 'use strict'

   $('.sp-vmslider-countdown[data-countdown]').each(function() {
      var $this = $(this), finalDate = $(this).data('countdown');
      $this.countdown(finalDate, function(event) {
         $this.html(event.strftime('<span class="sp-vm-slide-day">%D days,</span> <span class="sp-vm-slide-time">%H:%M:%S</span>'))}).on('finish.countdown', function() {
            $(this).html('<span class="sp-vm-slide-finished">Deal is over</span>');
          });
    });

	// carousel countdown slider
    var spVmSliderIILayout2 = $(".sp-vmslider-ii-slide-layout-2");
    var spVmSliderIILayout3 = $(".sp-vmslider-ii-small-countdown");

    var spVmSlider2 = $(".sp-vmslider-ii-slide");

    spVmSlider2.owlCarousel({
        loop: true,
        lazyLoad : true,
        dots: true,
        slideBy: 3,
        autoplay: true,
        autoplayTimeout: 4500,
        autoplaySpeed: 300,
        nav: false,
        navText: ["<a class='fa fa-angle-left carousel-nav-left'></a>", "<a class='fa fa-angle-right carousel-nav-right'></a>"],
        responsive:{
            0:{
                items:1
            },
            767:{
                items:2
            },
            1000:{
                items: 3
            }
        },

        onInitialized: function() {
            $('.owl-item.active').last().addClass('last-owl-active-item');
        },
        onTranslated: function() {
            $(event.target).find('.last-owl-active-item').removeClass('last-owl-active-item');
            $(event.target).find('.active').last().addClass('last-owl-active-item');
        }
    });

    spVmSliderIILayout3.owlCarousel({
        loop: true,
        lazyLoad : true,
        dots: false,
        nav: false,
        margin: 30,
        navText: ["<a class='fa fa-angle-left carousel-nav-left'></a>", "<a class='fa fa-angle-right carousel-nav-right'></a>"],
        responsive:{
            0:{
                items:1
            },
            767:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });

    spVmSliderIILayout2.owlCarousel({
        loop: true,
        lazyLoad : true,
        dots: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        nav: false,
        navText: ["<a class='fa fa-angle-left carousel-nav-left'></a>", "<a class='fa fa-angle-right carousel-nav-right'></a>"],
        responsive:{
            0:{
                items:1
            },
            767:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});
