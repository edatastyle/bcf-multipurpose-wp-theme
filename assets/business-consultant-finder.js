(function(jQuery) {
    'use strict';
    jQuery(document).ready(function($) {

   
	/* ============== masonry Grid ============= */
	if( $(".rd-navbar").length){
		$('.rd-navbar').RDNavbar({
			stickUpClone: false,
			
			
		});
	}
	if( $('#ui-to-top').length ){
		$('#ui-to-top').on('click', function() {
			$("html, body").animate({ scrollTop: 0 }, 500);
			return false;
		});
		
		$(window).scroll(function() {
			if ( $(this).scrollTop() > 100 ) {
				
				$('#ui-to-top').addClass('active');
			} else {
			  
				$('#ui-to-top').removeClass('active');
			}
			
		});
	}
	
  if( $('.bcf-own-carousel .gallery,.gallery-media.wp-block-gallery ul.wp-block-gallery').length ){
		$(".bcf-own-carousel .gallery,.gallery-media.wp-block-gallery ul.wp-block-gallery").owlCarousel({
			stagePadding: 0,
			loop: true,
			autoplay: true,
			autoplayTimeout: 2000,
			margin: 0,
			nav: false,
			dots: false,
			smartSpeed: 1000,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
	}
	
	/* -- image-popup */
	if( $('.image-popup').length ){
		 $('.image-popup').magnificPopup({
			closeBtnInside : true,
			type           : 'image',
			mainClass      : 'mfp-with-zoom'
		});
	}
	

	
	if( $('.rd-navbar-static .rd-navbar-nav li > a').length ){
		$( ".rd-navbar-static .rd-navbar-nav li > a" ).keyup(function() {
			
			$(this).parent('li').prev('li').removeClass('focus');	
			
			if( $(this).parents('li.rd-navbar-submenu').length ){
				$(this).parent('li').addClass('focus');
			}
			
		});
	}
	if( $('.rd-navbar-fixed .rd-navbar-nav li > a').length ){
		$( ".rd-navbar-fixed .rd-navbar-nav li > a" ).keyup(function() {
			
			$(this).parent('li').prev('li').removeClass('opened');	
			
			if( $(this).parents('li.rd-navbar-submenu').length ){
			
				$(this).parent('li').addClass('opened');
			}
			
		});
	}
	
	$( ".rd-navbar-toggle.toggle-original" ).keyup(function() {
		$(this).addClass('active');
		$('.rd-navbar-nav-wrap.toggle-original-elements').addClass('active');
	});
	
	$('#static_header_banner,#content').on('keydown', function(event) {
		
		$('.rd-navbar-static .rd-navbar-nav li.menu-item-has-children').removeClass('opened').removeClass('focus');
		$('.rd-navbar-toggle.toggle-original').removeClass('active');
		$('.rd-navbar-nav-wrap.toggle-original-elements').removeClass('active');
		
	});
	
	
	//skrollr.init();
	
 });
})(jQuery);