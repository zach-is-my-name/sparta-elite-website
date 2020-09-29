<?php
/**
 * Construction Sites functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @subpackage Construction Sites
 * @since Construction Sites 1.0
 */

/**
 * Construction Sites only works in WordPress 4.7 or later.
 */

if ( ! function_exists( 'construction_sites_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function construction_sites_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Construction Sites, use a find and replace
		 * to change 'construction-sites' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'construction-sites');
        
		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in single locations.
		add_theme_support( 'nav-menus' );
		register_nav_menu('primary', esc_html__( 'Primary Menu', 'construction-sites' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add the custom background prperty
		add_theme_support( 'custom-background', apply_filters( 'construction_sites_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add supportive refresh widgets 
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// Add default posts and comments RSS feed links 
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'construction_sites_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function construction_sites_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'construction_sites_content_width', 640 );
}
add_action( 'after_setup_theme', 'construction_sites_content_width', 0 );

/**
 * Set the theme version, based on theme stylesheet.
 *
 * @global string $construction_sites_theme_version
 */
function construction_sites_theme_version_info() {
	$construction_sites_theme_info = wp_get_theme();
	$GLOBALS['construction_sites_theme_version'] = $construction_sites_theme_info->get( 'Version' );
}
add_action( 'after_setup_theme', 'construction_sites_theme_version_info', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function construction_sites_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'construction-sites' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'construction-sites' ),
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="title-sep2 mb-30">',
		'after_title'   => '</h4>',
	) );


	     register_sidebar(array(
		'name' => esc_html__( 'Footer Widget Area', "construction-sites"),
		'id' => 'footer-widget-area',
		'description' => esc_html__( 'The footer widget area', "construction-sites"),
		'before_widget' => '<div class="%2$s footer-widget col-md-3 col-sm-6 col-xs-12">',
		'after_widget' => '</div>',
		'before_title' => '<div class="foot-title"><h4>',
		'after_title' => '</h4></div>',
	));	
}
add_action( 'widgets_init', 'construction_sites_widgets_init' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * File to manage the custom body classes
 */
require get_template_directory() . '/inc/template-css-class.php';
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Add feature in Customizer  
 */
require get_template_directory() . '/inc/customizer/cv-customizer.php';


/**
 * Custom Hooks defined 
 */
require get_template_directory() . '/inc/custom-hooks/cv-custom-hooks.php';
require get_template_directory() . '/inc/custom-hooks/footer-hooks.php';
require get_template_directory() . '/inc/custom-hooks/header-hooks.php';



/**
 * Breadcrumbs files added 
 */

	require get_template_directory() . '/inc/breadcrumbs.php';
 
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Construction Sites
 */

/**
 * Header fearures expanded 
 */
function construction_sites_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'construction_sites_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '#ffffff',
		'width'                  => 1920,
		'height'                 => 850,
		'flex-height'            => true,
		'wp-head-callback'       => 'construction_sites_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'construction_sites_custom_header_setup' );

if ( ! function_exists( 'construction_sites_header_style' ) ) :

	function construction_sites_header_style() {
		$header_text_color = get_header_textcolor();

		?>
		<style type="text/css">
			<?php
				//Check if user has defined any header image.
				if ( get_header_image() ) :
			?>
			.page-banner
			  {
				background-image:url('<?php header_image(); ?>');
			  }
		
			.site-title,.site-description
			 {
			color: #<?php echo esc_attr($header_text_color); ?>;
			
			  }

			<?php endif; ?>	
		</style>
		<?php
	}
endif;	

/**
 * Customizer additional settings.
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/custom-addition/class-customize.php' );