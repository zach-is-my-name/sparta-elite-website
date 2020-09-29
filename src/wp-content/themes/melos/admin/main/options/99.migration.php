<?php
/**
 * Migration functions.
 *
 * Allows seemless transition from pre v1.5.0 as a result of removing Redux.
 * 
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	MIGRATE SLIDER - pre v1.5.0 to v1.5.0 (REDUX REMOVED)
---------------------------------------------------------------------------------- */

function thinkup_migrate_slider_20190829_v150() {

	// Reset variable values
	$count                   = NULL;
	$slider                  = NULL;
	$slider_switch           = NULL;
	$migration_check         = NULL;
	$thinkup_redux_variables = NULL;

	// Get options array
	$thinkup_redux_variables = get_option( 'thinkup_redux_variables' );

	// Get option values
	if( ! empty( $thinkup_redux_variables['thinkup_homepage_sliderpreset'] ) ) {
		$slider = $thinkup_redux_variables['thinkup_homepage_sliderpreset'];
	}
	if( ! empty( $thinkup_redux_variables['thinkup_homepage_sliderswitch'] ) ) {
		$slider_switch = $thinkup_redux_variables['thinkup_homepage_sliderswitch'];
	}
	if( ! empty( $thinkup_redux_variables['thinkup_migrate_slider_20190829_v150'] ) ) {
		$migration_check = $thinkup_redux_variables['thinkup_migrate_slider_20190829_v150'];
	}

	// Skip if migration has already taken place
	if( $migration_check !== 1 and is_array( $slider ) ) {

		// Loop through each slide and migrate content.
		foreach( $slider as $slide ) {

			// Increase count increment
			$count++;

			// Only migrate first 3 slides
			if( $count <= 3 ) {

				// Assign slide values (no sanitization needed as we're just moving from 1 part of the options array to another in the same option)
				$thinkup_redux_variables['thinkup_homepage_sliderimage' . $count . '_image']['url'] = wp_get_attachment_url( $slide['slide_image_id'] );
				$thinkup_redux_variables['thinkup_homepage_sliderimage' . $count . '_title']        = $slide['slide_title'];
				$thinkup_redux_variables['thinkup_homepage_sliderimage' . $count . '_desc']         = $slide['slide_description'];

			}
		}

		// Enable Image Slider if currently set to enable ThinkUpSlider
		if( $slider_switch == 'option1' ) {
			$thinkup_redux_variables['thinkup_homepage_sliderswitch'] = 'option4';
		}

		// Set migration flag
		$thinkup_redux_variables['thinkup_migrate_slider_20190829_v150'] = 1;

		// Update options array
		update_option( 'thinkup_redux_variables', $thinkup_redux_variables );
	}
}
add_action( 'init', 'thinkup_migrate_slider_20190829_v150' );