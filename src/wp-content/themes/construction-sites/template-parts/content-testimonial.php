<?php 
$construction_sites_enable_testimonial_section = get_theme_mod( 'construction_sites_enable_testimonial_section', false );
$construction_sites_testimonial_title= get_theme_mod( 'construction_sites_testimonial_title','What People Say');
$construction_sites_testimonial_subtitle= get_theme_mod( 'construction_sites_testimonial_subtitle');
$construction_sites_testimonial_column = get_theme_mod( 'construction_sites_testimonial_column','4');

if($construction_sites_enable_testimonial_section == true ) {
   

        $construction_sites_testimonials_no        = 4;
        $construction_sites_testimonials_pages      = array();
        for( $i = 1; $i <= $construction_sites_testimonials_no; $i++ ) {
             $construction_sites_testimonials_pages[] = get_theme_mod('construction_sites_testimonial_page'.$i);

        }
        $construction_sites_testimonials_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $construction_sites_testimonials_pages ),
        'posts_per_page' => absint($construction_sites_testimonials_no),
        'orderby' => 'post__in'
        ); 
        $construction_sites_testimonials_query = new WP_Query( $construction_sites_testimonials_args );
      

?>
  <section class="testimonial-one bg-theme sp-100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php if(!empty($construction_sites_testimonial_title)) { ?>
          <div class="all-title white2">
            <h3 class="sec-title">
              <?php echo esc_html($construction_sites_testimonial_title); ?>
            </h3>
            <p><?php echo esc_html($construction_sites_testimonial_subtitle); ?></p>
          </div>
        <?php } ?>
        </div>
      </div>
      <div id='testi-custom-thumb' class="clearfix row">
         <?php
                    $count = 0;
                    while($construction_sites_testimonials_query->have_posts() && $count <= 4 ) :
                    $construction_sites_testimonials_query->the_post();
                 ?> 
        <div class="col-lg-<?php echo esc_attr($construction_sites_testimonial_column); ?> col-md-6 col-sm-6 col-12 testi-dot">
          <?php if(has_post_thumbnail()){ ?>
          <div class="testi-inner">
            <?php the_post_thumbnail(); ?>
            <div class="testi-overlay">
              <div class="overlay-in">
                <h5 class="c-white mb-2">
                 <?php the_title(); ?>
                </h5>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
         <?php
                    $count = $count + 1;
                    endwhile;
                    wp_reset_postdata();
                ?> 
      </div>
      <div class="row">
        <div class="col-lg-10 offset-lg-1 col-12">
          <div class="testi-one-slider owl-carousel owl-theme">
             <?php
                    $count = 0;
                    while($construction_sites_testimonials_query->have_posts() && $count <= 5 ) :
                    $construction_sites_testimonials_query->the_post();
                 ?> 
            <div class="testi-item">
              <?php the_excerpt(); ?>
            </div>
             <?php
                    $count = $count + 1;
                    endwhile;
                    wp_reset_postdata();
                ?> 
          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>