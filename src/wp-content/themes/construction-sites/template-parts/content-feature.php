<?php 
$construction_sites_enable_feature_section = get_theme_mod( 'construction_sites_enable_feature_section', true );
$construction_sites_feature_column = get_theme_mod( 'construction_sites_feature_column','2');
        $construction_sites_features_no        = 8;
        $construction_sites_features_pages      = array();
        for( $i = 1; $i <= $construction_sites_features_no; $i++ ) {
             $construction_sites_features_pages[] = get_theme_mod('construction_sites_feature_page'.$i); 

        }
        $construction_sites_features_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $construction_sites_features_pages ),
        'posts_per_page' => absint($construction_sites_features_no),
        'orderby' => 'post__in'
        ); 
        $construction_sites_features_query = new WP_Query( $construction_sites_features_args );
      
if($construction_sites_enable_feature_section==true ) {
?>  
  <section class="service-two">
    <?php
        $count = 0;
        while($construction_sites_features_query->have_posts() && $count <= 7 ) :
        $construction_sites_features_query->the_post();
     ?> 
    <div class="service-box<?php echo esc_attr($construction_sites_feature_column); ?>">
      <?php if(has_post_thumbnail()): ?>
      <div class="s-icon-box">
        <?php the_post_thumbnail(); ?>
      </div>
    <?php endif; ?>
      <div class="s-content">
        <h5><?php the_title(); ?></h5>
        <?php the_excerpt(); ?>
      </div>
    </div>
    <?php
          $count = $count + 1;
          endwhile;
          wp_reset_postdata();
      ?>   
  </section>
  <?php } ?>