<?php
/**
 * Construction Sites manage the Customizer sections.
 *
 * @subpackage Construction Sites
 * @since 1.0 
 */

/**
 * Site Settings
 */
Kirki::add_section( 'construction_sites_section_site', array(
	'title'    => __( 'Site Settings', 'construction-sites' ),
	'panel'    => 'construction_sites_general_panel',
	'priority' => 40,
) );

/**
 * Hero Section
 */
Kirki::add_section( 'construction_sites_section_banner_content', array(
	'title'    => __( 'Home Banner Settings', 'construction-sites' ),
	'panel'    => 'construction_sites_frontpage_panel',
	'priority' => 5,
) );

/**
 * Blog Section
 */
Kirki::add_section( 'construction_sites_section_feature', array(
	'title'    => __( 'Home Feature Setting', 'construction-sites' ),
	'panel'    => 'construction_sites_frontpage_panel',
	'priority' => 7,
) );

/**
 * About Us Section
 */
Kirki::add_section( 'construction_sites_section_about_us', array(
	'title'    => __( 'Home About Setting', 'construction-sites' ),
	'panel'    => 'construction_sites_frontpage_panel',
	'priority' => 10,
) );

/**
 * Services Section
 */
Kirki::add_section( 'construction_sites_section_services', array(
	'title'    => __( 'Home Service Settings', 'construction-sites' ),
	'panel'    => 'construction_sites_frontpage_panel',
	'priority' => 15,
) );


/**
 * Portfolio Section
 */
Kirki::add_section( 'construction_sites_section_portfolio', array(
	'title'    => __( 'Home Portfolio Settings', 'construction-sites' ),
	'panel'    => 'construction_sites_frontpage_panel',
	'priority' => 15,
) );


/**
 * Contact Section
 */
Kirki::add_section( 'construction_sites_section_team', array(
	'title'    => __( 'Home Team Section', 'construction-sites' ),
	'panel'    => 'construction_sites_frontpage_panel',
	'priority' => 35,
) );

/**
 * Contact Section
 */
Kirki::add_section( 'construction_sites_section_testimonial', array(
	'title'    => __( 'Home Testimonial Section', 'construction-sites' ),
	'panel'    => 'construction_sites_frontpage_panel',
	'priority' => 40,
) );

/**
 * Blog Section
 */
Kirki::add_section( 'construction_sites_section_blog', array(
	'title'    => __( 'Home Blog Setting', 'construction-sites' ),
	'panel'    => 'construction_sites_frontpage_panel',
	'priority' => 45,
) );

/**
 * Blog Section
 */
Kirki::add_section( 'construction_sites_section_callout_content', array(
	'title'    => __( 'Home Callout Setting', 'construction-sites' ),
	'panel'    => 'construction_sites_frontpage_panel',
	'priority' => 47,
) );
/**
 * Footer Settings
 */
Kirki::add_section( 'construction_sites_footer_setting', array(
	'title'    => __( 'Footer Settings', 'construction-sites' ),
	'priority' => 40,
) );