<?php

/*---------------------------First highlight color-------------------*/

	$vw_minimalist_first_color = get_theme_mod('vw_minimalist_first_color');

	$vw_minimalist_custom_css= "";

	if($vw_minimalist_first_color != false){
		$vw_minimalist_custom_css .='.read-btn a, .more-btn a,input[type="submit"],#sidebar h3,.search-box i,.scrollup i,#footer a.custom_read_more, #sidebar a.custom_read_more,#sidebar .custom-social-icons i, #footer .custom-social-icons i,.pagination span, .pagination a,#footer-2,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.widget_product_search button,#comments input[type="submit"],#comments a.comment-reply-link,#slider .carousel-control-prev-icon, #slider .carousel-control-next-icon,nav.woocommerce-MyAccount-navigation ul li,.toggle-nav i, .woocommerce nav.woocommerce-pagination ul li a{';
			$vw_minimalist_custom_css .='background: '.esc_html($vw_minimalist_first_color).';';
		$vw_minimalist_custom_css .='}';
	}
	if($vw_minimalist_first_color != false){
		$vw_minimalist_custom_css .='a,.main-navigation a:hover,.main-navigation ul.sub-menu a:hover,.main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a,#slider .inner_carousel h1,.heading-text p,#sidebar ul li a:hover,#footer li a:hover{';
			$vw_minimalist_custom_css .='color: '.esc_html($vw_minimalist_first_color).';';
		$vw_minimalist_custom_css .='}';
	}	
	if($vw_minimalist_first_color != false){
		$vw_minimalist_custom_css .='.main-navigation ul ul{';
			$vw_minimalist_custom_css .='border-color: '.esc_html($vw_minimalist_first_color).';';
		$vw_minimalist_custom_css .='}';
	}
	
	/*---------------------------second highlight color-------------------*/

	$vw_minimalist_second_color = get_theme_mod('vw_minimalist_second_color');

	if($vw_minimalist_second_color != false){
		$vw_minimalist_custom_css .='.read-btn a:hover, .more-btn a:hover,input[type="submit"]:hover,#sidebar a.custom_read_more:hover, #footer a.custom_read_more:hover,#sidebar .custom-social-icons i:hover, #footer .custom-social-icons i:hover,.pagination .current,.pagination a:hover,#sidebar .tagcloud a:hover,#footer .tagcloud a:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current{';
			$vw_minimalist_custom_css .='background: '.esc_html($vw_minimalist_second_color).';';
		$vw_minimalist_custom_css .='}';
	}

	/*---------------------------Width Layout -------------------*/

	$vw_minimalist_theme_lay = get_theme_mod( 'vw_minimalist_width_option','Full Width');
    if($vw_minimalist_theme_lay == 'Boxed'){
		$vw_minimalist_custom_css .='body{';
			$vw_minimalist_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_minimalist_custom_css .='}';
		$vw_minimalist_custom_css .='#slider{';
			$vw_minimalist_custom_css .='right: 1%;';
		$vw_minimalist_custom_css .='}';
	}else if($vw_minimalist_theme_lay == 'Wide Width'){
		$vw_minimalist_custom_css .='body{';
			$vw_minimalist_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_minimalist_custom_css .='}';
	}else if($vw_minimalist_theme_lay == 'Full Width'){
		$vw_minimalist_custom_css .='body{';
			$vw_minimalist_custom_css .='max-width: 100%;';
		$vw_minimalist_custom_css .='}';
	}

	/*---------------------------Slider Content Layout -------------------*/

	$vw_minimalist_theme_lay = get_theme_mod( 'vw_minimalist_slider_content_option','Left');
    if($vw_minimalist_theme_lay == 'Left'){
		$vw_minimalist_custom_css .='#slider .carousel-caption{';
			$vw_minimalist_custom_css .='text-align:left;';
		$vw_minimalist_custom_css .='}';
	}else if($vw_minimalist_theme_lay == 'Center'){
		$vw_minimalist_custom_css .='#slider .carousel-caption{';
			$vw_minimalist_custom_css .='text-align:center;';
		$vw_minimalist_custom_css .='}';
	}else if($vw_minimalist_theme_lay == 'Right'){
		$vw_minimalist_custom_css .='#slider .carousel-caption{';
			$vw_minimalist_custom_css .='text-align:right;';
		$vw_minimalist_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_minimalist_theme_lay = get_theme_mod( 'vw_minimalist_blog_layout_option','Default');
    if($vw_minimalist_theme_lay == 'Default'){
		$vw_minimalist_custom_css .='.post-main-box{';
			$vw_minimalist_custom_css .='';
		$vw_minimalist_custom_css .='}';
	}else if($vw_minimalist_theme_lay == 'Center'){
		$vw_minimalist_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p{';
			$vw_minimalist_custom_css .='text-align:center;';
		$vw_minimalist_custom_css .='}';
		$vw_minimalist_custom_css .='.post-info{';
			$vw_minimalist_custom_css .='margin-top:10px;';
		$vw_minimalist_custom_css .='}';
	}else if($vw_minimalist_theme_lay == 'Left'){
		$vw_minimalist_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, #our-services p{';
			$vw_minimalist_custom_css .='text-align:Left;';
		$vw_minimalist_custom_css .='}';
		$vw_minimalist_custom_css .='.post-main-box h2{';
			$vw_minimalist_custom_css .='margin-top:10px;';
		$vw_minimalist_custom_css .='}';
	}

	/*----------------Responsive Media -----------------------*/

	$vw_minimalist_resp_stickyheader = get_theme_mod( 'vw_minimalist_stickyheader_hide_show',false);
	if($vw_minimalist_resp_stickyheader == true && get_theme_mod( 'vw_minimalist_sticky_header') == false){
		$vw_minimalist_custom_css .='.header-fixed{';
			$vw_minimalist_custom_css .='display:none;';
			$vw_minimalist_custom_css .='} ';
	}
	if($vw_minimalist_resp_stickyheader == true){
		$vw_minimalist_custom_css .='@media screen and (max-width:575px) {';
			$vw_minimalist_custom_css .='.header-fixed{';
				$vw_minimalist_custom_css .='display:block;';
			$vw_minimalist_custom_css .='} }';
	}else if($vw_minimalist_resp_stickyheader == false){
		$vw_minimalist_custom_css .='@media screen and (max-width:575px) {';
			$vw_minimalist_custom_css .='.header-fixed{';
				$vw_minimalist_custom_css .='display:none;';
			$vw_minimalist_custom_css .='} }';
	}

	$vw_minimalist_resp_slider = get_theme_mod( 'vw_minimalist_resp_slider_hide_show',false);
    if($vw_minimalist_resp_slider == true){
    	$vw_minimalist_custom_css .='@media screen and (max-width:575px) {';
		$vw_minimalist_custom_css .='#slider{';
			$vw_minimalist_custom_css .='display:block;';
		$vw_minimalist_custom_css .='} }';
	}else if($vw_minimalist_resp_slider == false){
		$vw_minimalist_custom_css .='@media screen and (max-width:575px) {';
		$vw_minimalist_custom_css .='#slider{';
			$vw_minimalist_custom_css .='display:none;';
		$vw_minimalist_custom_css .='} }';
	}

	$vw_minimalist_resp_metabox = get_theme_mod( 'vw_minimalist_metabox_hide_show',true);
    if($vw_minimalist_resp_metabox == true){
    	$vw_minimalist_custom_css .='@media screen and (max-width:575px) {';
		$vw_minimalist_custom_css .='.post-info{';
			$vw_minimalist_custom_css .='display:block;';
		$vw_minimalist_custom_css .='} }';
	}else if($vw_minimalist_resp_metabox == false){
		$vw_minimalist_custom_css .='@media screen and (max-width:575px) {';
		$vw_minimalist_custom_css .='.post-info{';
			$vw_minimalist_custom_css .='display:none;';
		$vw_minimalist_custom_css .='} }';
	}

	$vw_minimalist_resp_sidebar = get_theme_mod( 'vw_minimalist_sidebar_hide_show',true);
    if($vw_minimalist_resp_sidebar == true){
    	$vw_minimalist_custom_css .='@media screen and (max-width:575px) {';
		$vw_minimalist_custom_css .='#sidebar{';
			$vw_minimalist_custom_css .='display:block;';
		$vw_minimalist_custom_css .='} }';
	}else if($vw_minimalist_resp_sidebar == false){
		$vw_minimalist_custom_css .='@media screen and (max-width:575px) {';
		$vw_minimalist_custom_css .='#sidebar{';
			$vw_minimalist_custom_css .='display:none;';
		$vw_minimalist_custom_css .='} }';
	}

	$vw_minimalist_resp_scroll_top = get_theme_mod( 'vw_minimalist_resp_scroll_top_hide_show',false);
    if($vw_minimalist_resp_scroll_top == true){
    	$vw_minimalist_custom_css .='@media screen and (max-width:575px) {';
		$vw_minimalist_custom_css .='.scrollup i{';
			$vw_minimalist_custom_css .='display:block;';
		$vw_minimalist_custom_css .='} }';
	}else if($vw_minimalist_resp_scroll_top == false){
		$vw_minimalist_custom_css .='@media screen and (max-width:575px) {';
		$vw_minimalist_custom_css .='.scrollup i{';
			$vw_minimalist_custom_css .='display:none !important;';
		$vw_minimalist_custom_css .='} }';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$vw_minimalist_sticky_header_padding = get_theme_mod('vw_minimalist_sticky_header_padding');
	if($vw_minimalist_sticky_header_padding != false){
		$vw_minimalist_custom_css .='.header-fixed, .page-template-custom-home-page .header-fixed{';
			$vw_minimalist_custom_css .='padding: '.esc_html($vw_minimalist_sticky_header_padding).';';
		$vw_minimalist_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_minimalist_button_padding_top_bottom = get_theme_mod('vw_minimalist_button_padding_top_bottom');
	$vw_minimalist_button_padding_left_right = get_theme_mod('vw_minimalist_button_padding_left_right');
	if($vw_minimalist_button_padding_top_bottom != false || $vw_minimalist_button_padding_left_right != false){
		$vw_minimalist_custom_css .='.post-main-box .more-btn a{';
			$vw_minimalist_custom_css .='padding-top: '.esc_html($vw_minimalist_button_padding_top_bottom).'; padding-bottom: '.esc_html($vw_minimalist_button_padding_top_bottom).';padding-left: '.esc_html($vw_minimalist_button_padding_left_right).';padding-right: '.esc_html($vw_minimalist_button_padding_left_right).';';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_button_border_radius = get_theme_mod('vw_minimalist_button_border_radius');
	if($vw_minimalist_button_border_radius != false){
		$vw_minimalist_custom_css .='.post-main-box .more-btn a{';
			$vw_minimalist_custom_css .='border-radius: '.esc_html($vw_minimalist_button_border_radius).'px;';
		$vw_minimalist_custom_css .='}';
	}

	/*------------- Single Blog Page------------------*/

	$vw_minimalist_single_blog_post_navigation_show_hide = get_theme_mod('vw_minimalist_single_blog_post_navigation_show_hide',true);
	if($vw_minimalist_single_blog_post_navigation_show_hide != true){
		$vw_minimalist_custom_css .='.post-navigation{';
			$vw_minimalist_custom_css .='display: none;';
		$vw_minimalist_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_minimalist_copyright_alingment = get_theme_mod('vw_minimalist_copyright_alingment');
	if($vw_minimalist_copyright_alingment != false){
		$vw_minimalist_custom_css .='.copyright p{';
			$vw_minimalist_custom_css .='text-align: '.esc_html($vw_minimalist_copyright_alingment).';';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_copyright_padding_top_bottom = get_theme_mod('vw_minimalist_copyright_padding_top_bottom');
	if($vw_minimalist_copyright_padding_top_bottom != false){
		$vw_minimalist_custom_css .='#footer-2{';
			$vw_minimalist_custom_css .='padding-top: '.esc_html($vw_minimalist_copyright_padding_top_bottom).'; padding-bottom: '.esc_html($vw_minimalist_copyright_padding_top_bottom).';';
		$vw_minimalist_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$vw_minimalist_scroll_to_top_font_size = get_theme_mod('vw_minimalist_scroll_to_top_font_size');
	if($vw_minimalist_scroll_to_top_font_size != false){
		$vw_minimalist_custom_css .='.scrollup i{';
			$vw_minimalist_custom_css .='font-size: '.esc_html($vw_minimalist_scroll_to_top_font_size).';';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_scroll_to_top_padding = get_theme_mod('vw_minimalist_scroll_to_top_padding');
	$vw_minimalist_scroll_to_top_padding = get_theme_mod('vw_minimalist_scroll_to_top_padding');
	if($vw_minimalist_scroll_to_top_padding != false){
		$vw_minimalist_custom_css .='.scrollup i{';
			$vw_minimalist_custom_css .='padding-top: '.esc_html($vw_minimalist_scroll_to_top_padding).';padding-bottom: '.esc_html($vw_minimalist_scroll_to_top_padding).';';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_scroll_to_top_width = get_theme_mod('vw_minimalist_scroll_to_top_width');
	if($vw_minimalist_scroll_to_top_width != false){
		$vw_minimalist_custom_css .='.scrollup i{';
			$vw_minimalist_custom_css .='width: '.esc_html($vw_minimalist_scroll_to_top_width).';';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_scroll_to_top_height = get_theme_mod('vw_minimalist_scroll_to_top_height');
	if($vw_minimalist_scroll_to_top_height != false){
		$vw_minimalist_custom_css .='.scrollup i{';
			$vw_minimalist_custom_css .='height: '.esc_html($vw_minimalist_scroll_to_top_height).';';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_scroll_to_top_border_radius = get_theme_mod('vw_minimalist_scroll_to_top_border_radius');
	if($vw_minimalist_scroll_to_top_border_radius != false){
		$vw_minimalist_custom_css .='.scrollup i{';
			$vw_minimalist_custom_css .='border-radius: '.esc_html($vw_minimalist_scroll_to_top_border_radius).'px;';
		$vw_minimalist_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$vw_minimalist_social_icon_font_size = get_theme_mod('vw_minimalist_social_icon_font_size');
	if($vw_minimalist_social_icon_font_size != false){
		$vw_minimalist_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_minimalist_custom_css .='font-size: '.esc_html($vw_minimalist_social_icon_font_size).';';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_social_icon_padding = get_theme_mod('vw_minimalist_social_icon_padding');
	if($vw_minimalist_social_icon_padding != false){
		$vw_minimalist_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_minimalist_custom_css .='padding: '.esc_html($vw_minimalist_social_icon_padding).';';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_social_icon_width = get_theme_mod('vw_minimalist_social_icon_width');
	if($vw_minimalist_social_icon_width != false){
		$vw_minimalist_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_minimalist_custom_css .='width: '.esc_html($vw_minimalist_social_icon_width).';';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_social_icon_height = get_theme_mod('vw_minimalist_social_icon_height');
	if($vw_minimalist_social_icon_height != false){
		$vw_minimalist_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_minimalist_custom_css .='height: '.esc_html($vw_minimalist_social_icon_height).';';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_social_icon_border_radius = get_theme_mod('vw_minimalist_social_icon_border_radius');
	if($vw_minimalist_social_icon_border_radius != false){
		$vw_minimalist_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_minimalist_custom_css .='border-radius: '.esc_html($vw_minimalist_social_icon_border_radius).'px;';
		$vw_minimalist_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$vw_minimalist_products_padding_top_bottom = get_theme_mod('vw_minimalist_products_padding_top_bottom');
	if($vw_minimalist_products_padding_top_bottom != false){
		$vw_minimalist_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_minimalist_custom_css .='padding-top: '.esc_html($vw_minimalist_products_padding_top_bottom).'!important; padding-bottom: '.esc_html($vw_minimalist_products_padding_top_bottom).'!important;';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_products_padding_left_right = get_theme_mod('vw_minimalist_products_padding_left_right');
	if($vw_minimalist_products_padding_left_right != false){
		$vw_minimalist_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_minimalist_custom_css .='padding-left: '.esc_html($vw_minimalist_products_padding_left_right).'!important; padding-right: '.esc_html($vw_minimalist_products_padding_left_right).'!important;';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_products_box_shadow = get_theme_mod('vw_minimalist_products_box_shadow');
	if($vw_minimalist_products_box_shadow != false){
		$vw_minimalist_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$vw_minimalist_custom_css .='box-shadow: '.esc_html($vw_minimalist_products_box_shadow).'px '.esc_html($vw_minimalist_products_box_shadow).'px '.esc_html($vw_minimalist_products_box_shadow).'px #ddd;';
		$vw_minimalist_custom_css .='}';
	}

	$vw_minimalist_products_border_radius = get_theme_mod('vw_minimalist_products_border_radius');
	if($vw_minimalist_products_border_radius != false){
		$vw_minimalist_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_minimalist_custom_css .='border-radius: '.esc_html($vw_minimalist_products_border_radius).'px;';
		$vw_minimalist_custom_css .='}';
	}