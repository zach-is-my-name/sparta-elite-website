<?php
/*
Plugin Name: Appointlet
Plugin URI: https://www.appointlet.com/
Description: Appointment Scheduling Built for Google Calendar
Version: 2.0
Author: Appointlet
Author URI: https://www.appointlet.com/
Author Email: help@appointlet.com
Text Domain: en_US
Domain Path: /lang/
Network: false
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2013 Appointlet (help@appointlet.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Appointlet_Widget extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	
	/**
	 * Specifies the classname and description, instantiates the widget, 
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {
	
		// load plugin text domain
		add_action( 'init', array( $this, 'widget_textdomain' ) );
		
		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		
		$widget_options = array(
			'classname' => 'appointlet',
			'description' => __( 'Appointlet button users can click to open your scheduler.', 'en_US' )
		);

		//$control_options = array( 'width' => 245, 'height' => 400 );

		parent::__construct('appointlet', __( 'Appointlet', 'en_US' ), $widget_options);
		
		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
	
		// Register site styles and scripts
		//add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
		//add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );
		
	} // end constructor

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/
	
	/**
	 * Outputs the content of the widget.
	 *
	 * @param	array	args		The array of form elements
	 * @param	array	instance	The current instance of the widget
	 */
	public function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		
		echo $before_widget;    
		include( plugin_dir_path( __FILE__ ) . '/views/widget.php' );
		echo $after_widget;
	}
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param	array	new_instance	The previous instance of values before the update.
	 * @param	array	old_instance	The new instance of values to be generated via the update.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		unset($instance['appointlet_button_custom']);
		return $instance;	
	}
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array	instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {
		$defaults = array('button' => '//dje0x8zlxc38k.cloudfront.net/buttons/booknow-red.png');
		$instance = wp_parse_args((array)$instance, $defaults);
		extract($instance);
		include( plugin_dir_path(__FILE__) . '/views/admin.php' );	
	}

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/
	
	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function widget_textdomain() {
		// TODO be sure to change 'widget-name' to the name of *your* plugin
		load_plugin_textdomain( 'en_US', false, plugin_dir_path( __FILE__ ) . '/lang/' );	
	}
	
	/**
	 * Fired when the plugin is activated.
	 *
	 * @param		boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public function activate( $network_wide ) {
	
	} 
	
	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	public function deactivate( $network_wide ) {
		
	}
	
	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {
		wp_enqueue_style( 'appointlet-admin-styles', plugins_url( 'appointlet/css/admin.css' ) );
	}

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */	
	public function register_admin_scripts() {
		wp_enqueue_script( 'appointlet-admin-script', plugins_url( 'appointlet/js/admin.js' ) );
	}
	
	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {
		wp_enqueue_style( 'appointlet-widget-styles', plugins_url( 'appointlet/css/widget.css' ) );
	}
	
	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {
		wp_enqueue_script( 'appointlet-script', plugins_url( 'appointlet/js/widget.js' ) );
	}

	public function get_buttons() {
		return array(
		   __('red') => "//dje0x8zlxc38k.cloudfront.net/buttons/booknow-red.png",
		   __('green') => "//dje0x8zlxc38k.cloudfront.net/buttons/booknow-green.png",
		   __('blue') => "//dje0x8zlxc38k.cloudfront.net/buttons/booknow-blue.png",
		   __('gray') => "//dje0x8zlxc38k.cloudfront.net/buttons/booknow-gray.png",
		   __('brown') => "//dje0x8zlxc38k.cloudfront.net/buttons/booknow-brown.png",
		   __('pink') => "//dje0x8zlxc38k.cloudfront.net/buttons/booknow-pink.png",
		   __('silver') => "//dje0x8zlxc38k.cloudfront.net/buttons/booknow-silver.png",
		   __('yellow') => "//dje0x8zlxc38k.cloudfront.net/buttons/booknow-yellow.png",
		   __('orange') => "//dje0x8zlxc38k.cloudfront.net/buttons/booknow-orange.png",
		   __('purple') => "//dje0x8zlxc38k.cloudfront.net/buttons/booknow-purple.png",
		);
	}
}

add_action( 'widgets_init', create_function( '', 'register_widget("Appointlet_Widget");' ) ); 