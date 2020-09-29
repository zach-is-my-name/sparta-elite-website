<?php
/**
 * Construction Sites manage the Customizer options of general panel.
 *
 * @subpackage Construction Sites
 * @since 1.0 
 */
Kirki::add_field(
	'construction_sites_config', array(
		'type'        => 'checkbox',
		'settings'    => 'construction_sites_home_posts',
		'label'       => esc_attr__( 'Checked to hide latest posts in homepage.', 'construction-sites' ),
		'section'     => 'static_front_page',
		'default'     => true,
	)
);

// Color Picker field for Primary Color
Kirki::add_field( 
	'construction_sites_config', array(
		'type'        => 'color',
		'settings'    => 'construction_sites_theme_color',
		'label'       => esc_html__( 'Primary Color', 'construction-sites' ),
		'section'     => 'colors',
		'default'     => '#ef9e23',
	)
);