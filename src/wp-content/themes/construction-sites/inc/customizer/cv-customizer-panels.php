<?php
/**
 * Construction Sites manage the Customizer panels.
 *
 * @subpackage Construction Sites
 * @since 1.0 
 */

/**
 * General Settings Panel
 */
Kirki::add_panel( 'construction_sites_general_panel', array(
	'priority' => 10,
	'title'    => __( 'General Settings', 'construction-sites' ),
) );

/**
 * Header Settings Panel
 */
Kirki::add_panel( 'construction_sites_header_panel', array(
	'priority' => 15,
	'title'    => __( 'Header Options', 'construction-sites' ),
) );

/**
 * Frontpage Settings Panel
 */
Kirki::add_panel( 'construction_sites_frontpage_panel', array(
	'priority' => 20,
	'title'    => __( 'Construction Sites HomePage', 'construction-sites' ),
) );

/**
 * Design Settings Panel
 */
Kirki::add_panel( 'construction_sites_design_panel', array(
	'priority' => 25,
	'title'    => esc_html__( 'Design Settings', 'construction-sites' ),
) );