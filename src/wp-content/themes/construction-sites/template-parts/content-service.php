<?php 
$construction_sites_enable_service_section = get_theme_mod( 'construction_sites_enable_service_section', false );
$construction_sites_service_title = get_theme_mod( 'construction_sites_service_title');
$construction_sites_service_subtitle = get_theme_mod( 'construction_sites_service_subtitle' );
$construction_sites_service_column = get_theme_mod( 'construction_sites_service_column');
if($construction_sites_enable_service_section==true ) {


        $construction_sites_services_no        = 8;
        $construction_sites_services_pages      = array();
        for( $i = 1; $i <= $construction_sites_services_no; $i++ ) {
             $construction_sites_services_pages[] = get_theme_mod('construction_sites_service_page'.$i); 

        }
        $construction_sites_services_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $construction_sites_services_pages ),
        'posts_per_page' => absint($construction_sites_services_no),
        'orderby' => 'post__in'
        ); 
        $construction_sites_services_query = new WP_Query( $construction_sites_services_args );
      

?>
    <section class="bg-w sp-100-70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if(!empty($construction_sites_service_title)) { ?>
                    <div class="all-title">
                        <h3 class="sec-title">
                            <?php echo esc_html($construction_sites_service_title); ?>
                        </h3>
                         <p><?php echo esc_html($construction_sites_service_subtitle); ?></p>
                    </div>
                <?php } ?>
                </div>
            </div>
            <div class="row">
                 <?php
                    $count = 0;
                    while($construction_sites_services_query->have_posts() && $count <= 8 ) :
                    $construction_sites_services_query->the_post();
                 ?> 
                <div class="col-xl-<?php echo esc_attr($construction_sites_service_column); ?> col-lg-4 col-md-6 col-12">
                  <div class="service-box">
						<?php if(has_post_thumbnail()): ?>
							<div class="class-img">
								<?php the_post_thumbnail(); ?>
							</div>
						<?php endif; ?>	
                        <div class="service-content">
                            <h5>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                            <p class="mb-0"><?php the_excerpt(); ?>
                            </p>
                        </div>
                    </div>
                </div>
                 <?php
                    $count = $count + 1;
                    endwhile;
                    wp_reset_postdata();
                ?> 
            </div>
        </div>
    </section>
<?php } ?>