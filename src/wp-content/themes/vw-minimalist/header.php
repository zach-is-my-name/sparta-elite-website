<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content-vw">
 *
 * @package VW Minimalist
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>
	  	<meta charset="<?php bloginfo( 'charset' ); ?>">
	  	<meta name="viewport" content="width=device-width">
	  	<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	<?php if ( function_exists( 'wp_body_open' ) )
		{
	    	wp_body_open();
	  	}else{
	    	do_action('wp_body_open');
	  	}
	?>

	<header role="banner">
		<a class="screen-reader-text skip-link" href="#maincontent" ><?php esc_html_e( 'Skip to content', 'vw-minimalist' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Skip to content', 'vw-minimalist' ); ?></span></a>
		<div class="home-page-header">
			<?php get_template_part('template-parts/header/middle-header'); ?>
		</div>
	</header>

	<?php if(get_theme_mod('vw_minimalist_loader_enable',true)==1){ ?>
	  	<div id="preloader">
		    <div id="status">
		      <?php $vw_minimalist_theme_lay = get_theme_mod( 'vw_minimalist_loader_icon','Two Way');
		        if($vw_minimalist_theme_lay == 'Two Way'){ ?>
		        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/two-way.gif" alt="" role="img"/>
		      <?php }else if($vw_minimalist_theme_lay == 'Dots'){ ?>
		        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/dots.gif" alt="" role="img"/>
		      <?php }else if($vw_minimalist_theme_lay == 'Rotate'){ ?>
		        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/rotate.gif" alt="" role="img"/>          
		      <?php } ?>
		    </div>
	  	</div>
	<?php } ?>