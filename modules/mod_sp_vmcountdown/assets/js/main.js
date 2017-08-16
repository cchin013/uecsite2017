jQuery(function ($) {

   $('.sp-vmcountdown-cdate[data-countdown]').each(function() {
      var $this = $(this), finalDate = $(this).data('countdown');
      $this.countdown(finalDate, function(event) {
         $this.html(event.strftime('<span class="sp-vm-slide-day">%D days,</span> <span class="sp-vm-slide-time">%H:%M:%S</span>'))}).on('finish.countdown', function() {
            $(this).html('<span class="sp-vm-slide-finished">Deal is over</span>');
          });
    });


	// carousel countdown slider
	var spVmCoundown = $(".sp-vmcountdown-slide");
	spVmCoundown.owlCarousel({
      loop:true,
      lazyLoad : true,
      dots:false,
      autoplay: true,
      autoplayTimeout: 4500,
      autoplaySpeed: 1500,
      
      nav:true,
      navText: ["<a class='sp-vm-slider-ii-prev fa fa-angle-left carousel-nav-left'></a>", "<a class='sp-vm-slider-ii-next fa fa-angle-right carousel-nav-right'></a>"],
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
