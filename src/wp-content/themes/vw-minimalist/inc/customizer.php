<?php
/**
 * VW Minimalist Theme Customizer
 *
 * @package VW Minimalist
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function vw_minimalist_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_minimalist_custom_controls' );

function vw_minimalist_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'vw_minimalist_customize_partial_blogname', 
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'vw_minimalist_customize_partial_blogdescription', 
	));

	//add home page setting pannel
	$vw_minimalist_parent_panel = new VW_Minimalist_WP_Customize_Panel( $wp_customize, 'vw_minimalist_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => 'VW Settings',
		'priority' => 10,
	));

	// Layout
	$wp_customize->add_section( 'vw_minimalist_left_right', array(
    	'title'      => __( 'General Settings', 'vw-minimalist' ),
		'panel' => 'vw_minimalist_panel_id'
	) );

	$wp_customize->add_setting('vw_minimalist_width_option',array(
        'default' => __('Full Width','vw-minimalist'),
        'sanitize_callback' => 'vw_minimalist_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Minimalist_Image_Radio_Control($wp_customize, 'vw_minimalist_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-minimalist'),
        'description' => __('Here you can change the width layout of Website.','vw-minimalist'),
        'section' => 'vw_minimalist_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('vw_minimalist_theme_options',array(
        'default' => __('Right Sidebar','vw-minimalist'),
        'sanitize_callback' => 'vw_minimalist_sanitize_choices'
	));
	$wp_customize->add_control('vw_minimalist_theme_options',array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-minimalist'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-minimalist'),
        'section' => 'vw_minimalist_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-minimalist'),
            'Right Sidebar' => __('Right Sidebar','vw-minimalist'),
            'One Column' => __('One Column','vw-minimalist'),
            'Three Columns' => __('Three Columns','vw-minimalist'),
            'Four Columns' => __('Four Columns','vw-minimalist'),
            'Grid Layout' => __('Grid Layout','vw-minimalist')
        ),
	) );

	$wp_customize->add_setting('vw_minimalist_page_layout',array(
        'default' => __('One Column','vw-minimalist'),
        'sanitize_callback' => 'vw_minimalist_sanitize_choices'
	));
	$wp_customize->add_control('vw_minimalist_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-minimalist'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-minimalist'),
        'section' => 'vw_minimalist_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-minimalist'),
            'Right Sidebar' => __('Right Sidebar','vw-minimalist'),
            'One Column' => __('One Column','vw-minimalist')
        ),
	) );

    //Sticky Header
	$wp_customize->add_setting( 'vw_minimalist_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_sticky_header',array(
        'label' => esc_html__( 'Sticky Header','vw-minimalist' ),
        'section' => 'vw_minimalist_left_right'
    )));

    $wp_customize->add_setting('vw_minimalist_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_left_right',
		'type'=> 'text'
	));

    //Pre-Loader
	$wp_customize->add_setting( 'vw_minimalist_loader_enable',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','vw-minimalist' ),
        'section' => 'vw_minimalist_left_right'
    )));

	$wp_customize->add_setting('vw_minimalist_loader_icon',array(
        'default' => __('Two Way','vw-minimalist'),
        'sanitize_callback' => 'vw_minimalist_sanitize_choices'
	));
	$wp_customize->add_control('vw_minimalist_loader_icon',array(
        'type' => 'select',
        'label' => __('Pre-Loader Type','vw-minimalist'),
        'section' => 'vw_minimalist_left_right',
        'choices' => array(
            'Two Way' => __('Two Way','vw-minimalist'),
            'Dots' => __('Dots','vw-minimalist'),
            'Rotate' => __('Rotate','vw-minimalist')
        ),
	) );
    
	//Slider
	$wp_customize->add_section( 'vw_minimalist_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-minimalist' ),
		'panel' => 'vw_minimalist_panel_id'
	) );

	$wp_customize->add_setting( 'vw_minimalist_slider_arrows',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_slider_arrows',array(
      	'label' => esc_html__( 'Show / Hide Slider','vw-minimalist' ),
      	'section' => 'vw_minimalist_slidersettings'
    )));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_minimalist_slider_arrows',array(
		'selector'        => '#slider .carousel-caption h1',
		'render_callback' => 'vw_minimalist_customize_partial_vw_minimalist_slider_arrows',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'vw_minimalist_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_minimalist_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_minimalist_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'vw-minimalist' ),
			'description' => __('Slider image size (350 x 350)','vw-minimalist'),
			'section'  => 'vw_minimalist_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting('vw_minimalist_slider_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( 'MORE ABOUT US', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_slidersettings',
		'type'=> 'text'
	));

	//content layout
	$wp_customize->add_setting('vw_minimalist_slider_content_option',array(
        'default' => __('Left','vw-minimalist'),
        'sanitize_callback' => 'vw_minimalist_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Minimalist_Image_Radio_Control($wp_customize, 'vw_minimalist_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-minimalist'),
        'section' => 'vw_minimalist_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ))));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_minimalist_slider_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_minimalist_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_minimalist_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-minimalist' ),
		'section'     => 'vw_minimalist_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_minimalist_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_minimalist_slider_speed', array(
		'default'  => 3000,
		'sanitize_callback'	=> 'vw_minimalist_sanitize_float'
	) );
	$wp_customize->add_control( 'vw_minimalist_slider_speed', array(
		'label' => esc_html__('Slider Transition Speed','vw-minimalist'),
		'section' => 'vw_minimalist_slidersettings',
		'type'  => 'number',
	) );
 
	//Services
	$wp_customize->add_section('vw_minimalist_services',array(
		'title'	=> __('Services Section','vw-minimalist'),
		'panel' => 'vw_minimalist_panel_id',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_minimalist_section_title', array( 
		'selector' => '.heading-text h2', 
		'render_callback' => 'vw_minimalist_customize_partial_vw_minimalist_section_title',
	));

	$wp_customize->add_setting('vw_minimalist_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_minimalist_section_text',array(
		'label'	=> __('Section Text','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( 'Services', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_services',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('vw_minimalist_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_minimalist_section_title',array(
		'label'	=> __('Section Title','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( 'Services We Provide', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_services',
		'type'=> 'text'
	));	

	$categories = get_categories();
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';	
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_minimalist_services_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_minimalist_sanitize_choices',
	));
	$wp_customize->add_control('vw_minimalist_services_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Category to display Latest Post','vw-minimalist'),		
		'section' => 'vw_minimalist_services',
	));

	//Services excerpt
	$wp_customize->add_setting( 'vw_minimalist_services_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_minimalist_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_minimalist_services_excerpt_number', array(
		'label'       => esc_html__( 'Services Excerpt length','vw-minimalist' ),
		'section'     => 'vw_minimalist_services',
		'type'        => 'range',
		'settings'    => 'vw_minimalist_services_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog Post
	$wp_customize->add_panel( $vw_minimalist_parent_panel );

	$BlogPostParentPanel = new VW_Minimalist_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
		'title' => __( 'Blog Post Settings', 'vw-minimalist' ),
		'panel' => 'vw_minimalist_panel_id',
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_minimalist_post_settings', array(
		'title' => __( 'Post Settings', 'vw-minimalist' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_minimalist_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'vw_minimalist_customize_partial_vw_minimalist_toggle_postdate', 
	));

	$wp_customize->add_setting( 'vw_minimalist_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-minimalist' ),
        'section' => 'vw_minimalist_post_settings'
    )));

    $wp_customize->add_setting( 'vw_minimalist_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_toggle_author',array(
		'label' => esc_html__( 'Author','vw-minimalist' ),
		'section' => 'vw_minimalist_post_settings'
    )));

    $wp_customize->add_setting( 'vw_minimalist_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-minimalist' ),
		'section' => 'vw_minimalist_post_settings'
    )));

    $wp_customize->add_setting( 'vw_minimalist_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_minimalist_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_toggle_tags', array(
		'label' => esc_html__( 'Tags','vw-minimalist' ),
		'section' => 'vw_minimalist_post_settings'
    )));

    $wp_customize->add_setting( 'vw_minimalist_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_minimalist_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_minimalist_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-minimalist' ),
		'section'     => 'vw_minimalist_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_minimalist_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog layout
    $wp_customize->add_setting('vw_minimalist_blog_layout_option',array(
        'default' => __('Default','vw-minimalist'),
        'sanitize_callback' => 'vw_minimalist_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_Minimalist_Image_Radio_Control($wp_customize, 'vw_minimalist_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','vw-minimalist'),
        'section' => 'vw_minimalist_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

    $wp_customize->add_setting('vw_minimalist_excerpt_settings',array(
        'default' => __('Excerpt','vw-minimalist'),
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_minimalist_sanitize_choices'
	));
	$wp_customize->add_control('vw_minimalist_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','vw-minimalist'),
        'section' => 'vw_minimalist_post_settings',
        'choices' => array(
        	'Content' => __('Content','vw-minimalist'),
            'Excerpt' => __('Excerpt','vw-minimalist'),
            'No Content' => __('No Content','vw-minimalist')
        ),
	) );

	$wp_customize->add_setting('vw_minimalist_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_post_settings',
		'type'=> 'text'
	));

    // Button Settings
	$wp_customize->add_section( 'vw_minimalist_button_settings', array(
		'title' => __( 'Button Settings', 'vw-minimalist' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting('vw_minimalist_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_minimalist_button_border_radius', array(
		'default'              => 50,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_minimalist_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_minimalist_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-minimalist' ),
		'section'     => 'vw_minimalist_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_minimalist_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'vw_minimalist_customize_partial_vw_minimalist_button_text', 
	));

    $wp_customize->add_setting('vw_minimalist_button_text',array(
		'default'=> 'READ MORE',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_button_text',array(
		'label'	=> __('Add Button Text','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_minimalist_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'vw-minimalist' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_minimalist_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'vw_minimalist_customize_partial_vw_minimalist_related_post_title', 
	));

    $wp_customize->add_setting( 'vw_minimalist_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_related_post',array(
		'label' => esc_html__( 'Related Post','vw-minimalist' ),
		'section' => 'vw_minimalist_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_minimalist_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_related_post_title',array(
		'label'	=> __('Add Related Post Title','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_minimalist_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_minimalist_sanitize_float'
	));
	$wp_customize->add_control('vw_minimalist_related_posts_count',array(
		'label'	=> __('Add Related Post Count','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_related_posts_settings',
		'type'=> 'number'
	));

	// Single Posts Settings
	$wp_customize->add_section( 'vw_minimalist_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'vw-minimalist' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'vw_minimalist_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_minimalist_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_single_blog_post_navigation_show_hide', array(
		'label' => esc_html__( 'Post Navigation','vw-minimalist' ),
		'section' => 'vw_minimalist_single_blog_settings'
    )));

	//navigation text
	$wp_customize->add_setting('vw_minimalist_single_blog_prev_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_single_blog_next_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_single_blog_settings',
		'type'=> 'text'
	));

    //404 Page Setting
	$wp_customize->add_section('vw_minimalist_404_page',array(
		'title'	=> __('404 Page Settings','vw-minimalist'),
		'panel' => 'vw_minimalist_panel_id',
	));	

	$wp_customize->add_setting('vw_minimalist_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_minimalist_404_page_title',array(
		'label'	=> __('Add Title','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_minimalist_404_page_content',array(
		'label'	=> __('Add Text','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( 'GO BACK', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_404_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('vw_minimalist_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','vw-minimalist'),
		'panel' => 'vw_minimalist_panel_id',
	));	

	$wp_customize->add_setting('vw_minimalist_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_social_icon_padding',array(
		'label'	=> __('Icon Padding','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_social_icon_width',array(
		'label'	=> __('Icon Width','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_social_icon_height',array(
		'label'	=> __('Icon Height','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_minimalist_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_minimalist_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_minimalist_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-minimalist' ),
		'section'     => 'vw_minimalist_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('vw_minimalist_responsive_media',array(
		'title'	=> __('Responsive Media','vw-minimalist'),
		'panel' => 'vw_minimalist_panel_id',
	));

    $wp_customize->add_setting( 'vw_minimalist_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_stickyheader_hide_show',array(
      'label' => esc_html__( 'Sticky Header','vw-minimalist' ),
      'section' => 'vw_minimalist_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_minimalist_resp_slider_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_resp_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','vw-minimalist' ),
      'section' => 'vw_minimalist_responsive_media'
    )));

	$wp_customize->add_setting( 'vw_minimalist_metabox_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_metabox_hide_show',array(
      'label' => esc_html__( 'Show / Hide Metabox','vw-minimalist' ),
      'section' => 'vw_minimalist_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_minimalist_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','vw-minimalist' ),
      'section' => 'vw_minimalist_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_minimalist_resp_scroll_top_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','vw-minimalist' ),
      'section' => 'vw_minimalist_responsive_media'
    )));

    $wp_customize->add_setting('vw_minimalist_res_menu_open_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Minimalist_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_minimalist_res_menu_open_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-minimalist'),
		'transport' => 'refresh',
		'section'	=> 'vw_minimalist_responsive_media',
		'setting'	=> 'vw_minimalist_res_menu_open_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_minimalist_res_menu_close_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Minimalist_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_minimalist_res_menu_close_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-minimalist'),
		'transport' => 'refresh',
		'section'	=> 'vw_minimalist_responsive_media',
		'setting'	=> 'vw_minimalist_res_menu_close_icon',
		'type'		=> 'icon'
	)));

	//Content Creation
	$wp_customize->add_section( 'vw_minimalist_content_section' , array(
    	'title' => __( 'Customize Home Page Settings', 'vw-minimalist' ),
		'priority' => null,
		'panel' => 'vw_minimalist_panel_id'
	) );

	$wp_customize->add_setting('vw_minimalist_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new VW_Minimalist_Content_Creation( $wp_customize, 'vw_minimalist_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-minimalist' ),
		),
		'section' => 'vw_minimalist_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-minimalist' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_minimalist_footer',array(
		'title'	=> __('Footer Settings','vw-minimalist'),
		'panel' => 'vw_minimalist_panel_id',
	));	

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_minimalist_footer_text', array( 
		'selector' => '.copyright p', 
		'render_callback' => 'vw_minimalist_customize_partial_vw_minimalist_footer_text', 
	));
	
	$wp_customize->add_setting('vw_minimalist_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_minimalist_footer_text',array(
		'label'	=> __('Copyright Text','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2019, .....', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_copyright_alingment',array(
        'default' => __('center','vw-minimalist'),
        'sanitize_callback' => 'vw_minimalist_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Minimalist_Image_Radio_Control($wp_customize, 'vw_minimalist_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','vw-minimalist'),
        'section' => 'vw_minimalist_footer',
        'settings' => 'vw_minimalist_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

    $wp_customize->add_setting('vw_minimalist_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_minimalist_footer_scroll',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_footer_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll to Top','vw-minimalist' ),
      	'section' => 'vw_minimalist_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_minimalist_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'vw_minimalist_customize_partial_vw_minimalist_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('vw_minimalist_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Minimalist_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_minimalist_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-minimalist'),
		'transport' => 'refresh',
		'section'	=> 'vw_minimalist_footer',
		'setting'	=> 'vw_minimalist_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_minimalist_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-minimalist'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_minimalist_scroll_to_top_border_radius', array(
		'default'              => 50,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_minimalist_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_minimalist_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-minimalist' ),
		'section'     => 'vw_minimalist_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting('vw_minimalist_scroll_top_alignment',array(
        'default' => __('Right','vw-minimalist'),
        'sanitize_callback' => 'vw_minimalist_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Minimalist_Image_Radio_Control($wp_customize, 'vw_minimalist_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-minimalist'),
        'section' => 'vw_minimalist_footer',
        'settings' => 'vw_minimalist_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

    //Woocommerce settings
	$wp_customize->add_section('vw_minimalist_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'vw-minimalist'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_minimalist_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','vw-minimalist' ),
		'section' => 'vw_minimalist_woocommerce_section'
    )));

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_minimalist_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_minimalist_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Minimalist_Toggle_Switch_Custom_Control( $wp_customize, 'vw_minimalist_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','vw-minimalist' ),
		'section' => 'vw_minimalist_woocommerce_section'
    )));

    //Products per page
    $wp_customize->add_setting('vw_minimalist_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'vw_minimalist_sanitize_float'
	));
	$wp_customize->add_control('vw_minimalist_products_per_page',array(
		'label'	=> __('Products Per Page','vw-minimalist'),
		'description' => __('Display on shop page','vw-minimalist'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'vw_minimalist_woocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('vw_minimalist_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_minimalist_sanitize_choices'
	));
	$wp_customize->add_control('vw_minimalist_products_per_row',array(
		'label'	=> __('Products Per Row','vw-minimalist'),
		'description' => __('Display on shop page','vw-minimalist'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'vw_minimalist_woocommerce_section',
		'type'=> 'select',
	));

	//Products padding
	$wp_customize->add_setting('vw_minimalist_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_minimalist_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_minimalist_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','vw-minimalist'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-minimalist'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-minimalist' ),
        ),
		'section'=> 'vw_minimalist_woocommerce_section',
		'type'=> 'text'
	));

	//Products box shadow
	$wp_customize->add_setting( 'vw_minimalist_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_minimalist_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_minimalist_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','vw-minimalist' ),
		'section'     => 'vw_minimalist_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products border radius
    $wp_customize->add_setting( 'vw_minimalist_products_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_minimalist_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_minimalist_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','vw-minimalist' ),
		'section'     => 'vw_minimalist_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    // Has to be at the top
	$wp_customize->register_panel_type( 'VW_Minimalist_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_Minimalist_WP_Customize_Section' );
}

add_action( 'customize_register', 'vw_minimalist_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class VW_Minimalist_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'vw_minimalist_panel';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class VW_Minimalist_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'vw_minimalist_section';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function vw_minimalist_customize_controls_scripts() {
  wp_enqueue_script( 'vw-minimalist-customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_minimalist_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Minimalist_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Minimalist_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new VW_Minimalist_Customize_Section_Pro( $manager,'example_1', array(
			'priority'   => 1,
			'title'    => esc_html__( 'VW Minimalist Pro', 'vw-minimalist' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-minimalist' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/minimalist-wordpress-theme/'),
		) )	);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-minimalist-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-minimalist-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Minimalist_Customize::get_instance();