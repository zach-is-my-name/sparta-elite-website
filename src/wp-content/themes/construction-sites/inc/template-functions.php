<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @subpackage Construction Sites
 * @since 1.0 
 */

/*-----------------------------------------------------------------------------------------------------------------------------------*/

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function construction_sites_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'construction_sites_pingback_header' );

/*-----------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'construction_sites_fonts_url' ) ) :

	/**
	 * Register Google fonts for Construction Sites.
	 *
	 * @return string Google fonts URL for the theme.
	 * @since 1.0.0
	 */

    function construction_sites_fonts_url() {

        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Lora translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Open+Sans: on or off', 'construction-sites' ) ) {
            $font_families[] = 'Open+Sans:400,600,700,800';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Poppins, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'construction-sites' ) ) {
            $font_families[] = 'Roboto:300,400,500,700,900';
        }   

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles for only admin
 *
 * @since 1.0.0
 */
function construction_sites_scripts() {

    global $construction_sites_theme_version;

    wp_enqueue_style( 'construction-sites', construction_sites_fonts_url(), array(), null );

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '', 'all');
    
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), '', 'all');

    wp_enqueue_style('construction-sites-header', get_template_directory_uri() . '/assets/css/header.css', array(), '', 'all');
    wp_enqueue_style('slicknav', get_template_directory_uri() . '/assets/css/slicknav.css', array(), '', 'all');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '', 'all'); 
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', array(), '', 'all');
     wp_enqueue_style('owl-theme-default', get_template_directory_uri() . '/assets/css/owl.theme.default.css', array(), '', 'all');

    wp_enqueue_style( 'responsive-style', get_template_directory_uri() .'/assets/css/responsive.css', array(), esc_attr( $construction_sites_theme_version ) );
    wp_enqueue_style( 'construction-sites-style', get_stylesheet_uri(), array(), esc_attr( $construction_sites_theme_version ) );
    wp_enqueue_style( 'construction-sites-style-extra', get_template_directory_uri() .'/assets/css/theme-extra.css' , array(), esc_attr( $construction_sites_theme_version ) );
    wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper.js', array(), '', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), true);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array(), '', true);
   wp_enqueue_script('slicknav', get_template_directory_uri() . '/assets/js/slicknav.js', array(), '', true);
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.js', array(), esc_attr( $construction_sites_theme_version ), true );
     wp_enqueue_script( 'magnific', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.js', array(), esc_attr( $construction_sites_theme_version ), true );
         wp_enqueue_script( 'construction-sites-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array(), esc_attr( $construction_sites_theme_version ), true );
	wp_enqueue_script( 'construction-sites-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), true );
        wp_enqueue_script( 'construction-sites-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '', true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'construction_sites_scripts' );


/*--------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'construction_sites_select_categories_list' ) ) :

    /**
     * function to return category lists
     *
     * @return $construction_sites_categories_list in array
     */
    
    function construction_sites_select_categories_list() {

        $construction_sites_get_categories = get_categories( array( 'hide_empty' => 0 ) );
        $construction_sites_categories_list[''] = __( 'Select Category', 'construction-sites' );

        foreach ( $construction_sites_get_categories as $category ) {
            $construction_sites_categories_list[esc_attr( $category->slug )] = esc_html( $category->cat_name );
        }
        
        return $construction_sites_categories_list;
    }

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/


if ( ! function_exists( 'construction_sites_single_post_navigation' ) ) :
/**
 * Displays an optional single post navigation
 *
 *
 * Create your own construction_sites_post_navigation() function to override in a child theme.
 *
 * @since Create Magazine 1.0
 */
function construction_sites_single_post_navigation() {

   

    the_post_navigation( array(
        'prev_text' => '<i class="fa fa-angle-left"></i>'.esc_html__( ' Previous Article','construction-sites' ),
        'next_text' => esc_html__( 'Next Article','construction-sites' ).' <i class="fa fa-angle-right"></i>'
    ) );
}
endif;



add_action( 'wp_enqueue_scripts', 'construction_sites_theme_color' );
if( ! function_exists( 'construction_sites_theme_color' ) ) :
  
    function construction_sites_theme_color() { 
        $construction_sites_theme_color = get_theme_mod( 'construction_sites_theme_color', '#ff5164' );
        $output_css = '';

         $output_css .= ".team-slider-two.owl-theme .owl-nav [class*=owl-]:hover, .team-slider-two.owl-theme .owl-nav [class*=owl-]:focus,.post-meta li a:hover, .post-meta li a:focus,h5 a:hover, h6 a:hover, h5 a:focus, h6 a:focus,.btn-two,.widget_categories a:hover, .widget_archive a:hover, .widget_categories a:focus, .widget_archive a:focus,.widget_meta a:hover, .widget_meta a:focus,.foot-bottom a,.main-navigation a:hover,.widget_recent_entries a:hover, .widget_recent_entries a:focus,.widget_recent_comments .recentcomments a:hover, .widget_recent_comments .recentcomments a:focus,.widget_recent_entries .post-date,.blog-detail .post-meta li a, .logged-in-as a,.read-more:hover, .read-more:focus,.blog-detail .post-meta li i,.comment-meta a,.says,.sp-100 .pagination-blog .navigation .nav-links a,.post-tags a:hover, .post-tags a:focus{color:".esc_attr( $construction_sites_theme_color ).";}"; 

        $output_css .= ".all-title .title-sep{ fill:".esc_attr( $construction_sites_theme_color )."; }";

        $output_css .= ".team-two:hover, .team-two:focus, .service-box:hover .service-content{ border-color:".esc_attr( $construction_sites_theme_color )."; }";
        $output_css .= ".btn-two:before, .btn-two:after{ border-bottom:".esc_attr( $construction_sites_theme_color ). " 25px solid ; !important;
border-top:".esc_attr( $construction_sites_theme_color ). " 25px solid ; !important
          }";
        $output_css .= ".search-form input[type='submit'],.widget_tag_cloud .tagcloud a:hover, .widget_tag_cloud .tagcloud a:focus,.pagination .nav-links .page-numbers.current, .pagination .nav-links .page-numbers:hover{ border-color:".esc_attr( $construction_sites_theme_color )."; }";


        $output_css .= ".btn-dark,.service-box2:after,.feature-box::after,.class-box:hover h5:before, .class-box:hover h5:after, .class-box:focus h5:before, .class-box:focus h5:after,section.cta,.foot-title h4::after,.main-navigation .nav-menu>.menu-item-has-children > .sub-menu li a:before,.search-form input[type='submit'],.title-sep2::after,::-webkit-scrollbar-thumb,::-webkit-scrollbar-thumb:hover,.comment-respond .comment-reply-title::after,.comment-respond .form-submit input,.widget_tag_cloud .tagcloud a:hover, .widget_tag_cloud .tagcloud a:focus,.pagination .nav-links .page-numbers.current, .pagination .nav-links .page-numbers:hover,.reply:hover, .reply:focus,.blog .blog-item:hover .date, .blog .blog-item:focus .date,.owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span, .owl-theme .owl-dots .owl-dot:focus span, .service-box3col:after,.service-box4col:after, .service-box:hover .service-content, .project:hover .proj-content, .project:focus .proj-content,.header-three,.bg-theme{ background-color:".esc_attr( $construction_sites_theme_color ).";}";

               $output_css .= "blockquote{ border-left:".esc_attr( $construction_sites_theme_color )." 5px solid; }";


       $construction_sites_output_css = construction_sites_css_strip_whitespace( $output_css );
        wp_add_inline_style( 'construction-sites-style', $construction_sites_output_css );
    }
endif;




if( ! function_exists( 'construction_sites_css_strip_whitespace' ) ) :
    
    /**
     * Get minified css and removed space
     *
     * @since 1.0.0
     */

    function construction_sites_css_strip_whitespace( $css ){
        $replace = array(
            "#/\*.*?\*/#s" => "",  // Strip C style comments.
            "#\s\s+#"      => " ", // Strip excess whitespace.
        );
        $search = array_keys( $replace );
        $css = preg_replace( $search, $replace, $css );

        $replace = array(
            ": "  => ":",
            "; "  => ";",
            " {"  => "{",
            " }"  => "}",
            ", "  => ",",
            "{ "  => "{",
            ";}"  => "}", // Strip optional semicolons.
            ",\n" => ",", // Don't wrap multiple selectors.
            "\n}" => "}", // Don't wrap closing braces.
            "} "  => "}\n", // Put each rule on it's own line.
        );
        $search = array_keys( $replace );
        $css = str_replace( $search, $replace, $css );

        return trim( $css );
    }

endif;


if( ! function_exists( 'construction_sites_select_page_list' ) ) :

    /**
     * function to return page lists
     *
     * @return $construction_sites_page_list in array
     */
    
    function construction_sites_select_page_list() {

        $construction_sites_get_pages = get_pages();
        $construction_sites_page_list[''] = __( 'Select Page', 'construction-sites' );

        foreach ( $construction_sites_get_pages as $page ) {
            $construction_sites_page_list[esc_attr( $page->post_name )] = esc_html( $page->post_title );
        }
        
        return $construction_sites_page_list;
    }

endif;