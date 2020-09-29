<?php
/**
 * Template part for displaying section of About Us content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @subpackage Construction Sites
 * @since 1.0 
 */

$construction_sites_enable_about_us_section = get_theme_mod( 'construction_sites_enable_about_us_section', true );
$construction_sites_about_button_label1 = get_theme_mod( 'construction_sites_about_button_label1');
$construction_sites_about_button_link1 = get_theme_mod( 'construction_sites_about_button_link1');

if($construction_sites_enable_about_us_section==true ) {
 

$construction_sites_about_page = get_theme_mod( 'construction_sites_about_page' );

if( !empty( $construction_sites_about_page ) ) {

	$page_args['page_id'] = absint( $construction_sites_about_page );

	$page_query = new WP_Query( $page_args );

	if( $page_query->have_posts() ) {
?>
	<section class="about-one sp-100-70 bg-dull">
		<?php
			while( $page_query->have_posts() ) {
				$page_query->the_post();
		?>	
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="all-title">
                        <h3 class="sec-title">
                            <?php the_title(); ?>
                        </h3>
                    </div>
                </div>
            </div>
            		
            <div class="row">
				<div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(has_post_thumbnail()): ?>
                            <div class="feature-box">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
                <div class="<?php if(!has_post_thumbnail()){ ?>col-lg-12<?php } else { ?> col-lg-6<?php } ?> mt-3 mt-lg-0">
                  <?php the_content(); ?>
                 <?php if($construction_sites_about_button_label1): ?>
					<a href="<?php echo esc_url($construction_sites_about_button_link1); ?>" class="btn btn-dark mr-3" target="_blank"><?php echo esc_html($construction_sites_about_button_label1); ?></a>
				<?php endif; ?>
                </div>
            </div>
        </div>
	 
        <?php
					}
                wp_reset_postdata();
				?>
    </section>
<?php
	}
}
}

if(have_posts()) : 
  while(have_posts()) : the_post();
    if(get_the_content()!= "")
    {
    ?>
      <section class="blog sp-100">
          <div class="container">
            <div class="row">
          <?php the_content(); ?> 
        </div>
        </div> 
      </section>  
    <?php 
    } 
  endwhile;
endif; 

?>