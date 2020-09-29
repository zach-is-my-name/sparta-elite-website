function vw_minimalist_menu_open_nav() {
	window.vw_minimalist_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function vw_minimalist_menu_close_nav() {
	window.vw_minimalist_responsiveMenu=false;
 	jQuery(".sidenav").removeClass('show');
}

jQuery(function($){
 	"use strict";
   	jQuery('.main-menu > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'
   	});
});

jQuery(document).ready(function () {
	window.vw_minimalist_currentfocus=null;
  	vw_minimalist_checkfocusdElement();
	var vw_minimalist_body = document.querySelector('body');
	vw_minimalist_body.addEventListener('keyup', vw_minimalist_check_tab_press);
	var vw_minimalist_gotoHome = false;
	var vw_minimalist_gotoClose = false;
	window.vw_minimalist_responsiveMenu=false;
 	function vw_minimalist_checkfocusdElement(){
	 	if(window.vw_minimalist_currentfocus=document.activeElement.className){
		 	window.vw_minimalist_currentfocus=document.activeElement.className;
	 	}
 	}
 	function vw_minimalist_check_tab_press(e) {
		"use strict";
		// pick passed event or global event object if passed one is empty
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.vw_minimalist_responsiveMenu){
			if (!e.shiftKey) {
				if(vw_minimalist_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				vw_minimalist_gotoHome = true;
			} else {
				vw_minimalist_gotoHome = false;
			}

		}else{

			if(window.vw_minimalist_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.vw_minimalist_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.vw_minimalist_responsiveMenu){
				if(vw_minimalist_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					vw_minimalist_gotoClose = true;
				} else {
					vw_minimalist_gotoClose = false;
				}
			
			}else{

			if(window.vw_minimalist_responsiveMenu){
			}}}}
		}
	 	vw_minimalist_checkfocusdElement();
	}
});

jQuery('document').ready(function($){
	jQuery(window).load(function() {
	    jQuery("#status").fadeOut();
	    jQuery("#preloader").delay(1000).fadeOut("slow");
	})
	$(window).scroll(function(){
		var sticky = $('.header-sticky'),
			scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('header-fixed');
		else sticky.removeClass('header-fixed');
	});
});

jQuery(document).ready(function () {
	jQuery(window).scroll(function () {
	    if (jQuery(this).scrollTop() > 100) {
	        jQuery('.scrollup i').fadeIn();
	    } else {
	        jQuery('.scrollup i').fadeOut();
	    }
	});
	jQuery('.scrollup').click(function () {
	    jQuery("html, body").animate({
	        scrollTop: 0
	    }, 600);
	    return false;
	});
});
