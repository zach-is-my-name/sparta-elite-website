<?php 
$construction_sites_enable_portfolio_section = get_theme_mod( 'construction_sites_enable_portfolio_section', false );
$construction_sites_portfolio_title = get_theme_mod( 'construction_sites_portfolio_title');
$construction_sites_portfolio_subtitle = get_theme_mod( 'construction_sites_portfolio_subtitle' );

if($construction_sites_enable_portfolio_section==true ) {
    

        $construction_sites_portfolio_no        = 8;
        $construction_sites_portfolio_page      = array();
        for( $k = 1; $k <= $construction_sites_portfolio_no; $k++ ) {
             $construction_sites_portfolio_page[] = get_theme_mod('construction_sites_portfolio_page'.$k); 

        }
        $construction_sites_portfolio_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $construction_sites_portfolio_page ),
        'posts_per_page' => absint($construction_sites_portfolio_no),
        'orderby' => 'post__in'
        ); 
        $construction_sites_portfolio_query = new WP_Query( $construction_sites_portfolio_args );
      

?>

  
 <!-- gallery start-->
    <section class="gallary-one bg-w sp-100">
		<div class="container">
		  <div class="row">
			<div class="col-12">
			  <?php if(!empty($construction_sites_portfolio_title)) { ?>
			  <div class="all-title">
				<h3 class="sec-title">
				   <?php echo esc_html($construction_sites_portfolio_title); ?>
				</h3>
				 <p><?php echo esc_html($construction_sites_portfolio_subtitle); ?></p>
			  </div>
			<?php } ?>
			</div>
		  </div>
     	</div>
        <div class="container-fluid px-30">
            <div class="row masonary-wrap">
				<?php
					$count = 0;
					while($construction_sites_portfolio_query->have_posts() && $count <= 8 ) :
					$construction_sites_portfolio_query->the_post();
				 ?> 
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 port-item mb-30 mas-item cardio fitness">
                    <div class="project">
						<?php if(has_post_thumbnail()): ?>
								<div class="proj-img">
									<?php the_post_thumbnail(); ?>
									<div class="proj-overlay">
										<a href="<?php the_post_thumbnail_url(); ?>" class="pop-btn">
											<i class="fa fa-image"></i>
										</a>
									</div>
								</div>
							<?php endif; ?>
								<div class="proj-content">
									<h5 class="mb-2"><?php echo the_title(); ?></h5>
									<h6 class="c-theme text-capitalize">
										<?php echo the_content();; ?>
									</h6>
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
    <!-- gallery end--> 
<?php } ?>