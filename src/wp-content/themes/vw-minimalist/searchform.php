<?php
/**
 * The template for displaying search forms in vw-minimalist
 *
 * @package VW Minimalist
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>		
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'vw-minimalist' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder','vw-minimalist' ); ?>" value="<?php echo get_search_query() ?>" name="s">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button','vw-minimalist' ); ?>">
</form>