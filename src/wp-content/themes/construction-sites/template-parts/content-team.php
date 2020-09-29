<?php 
$construction_sites_enable_team_section = get_theme_mod( 'construction_sites_enable_team_section', false );
$construction_sites_team_title  = get_theme_mod( 'construction_sites_team_title' );
$construction_sites_team_subtitle  = get_theme_mod( 'construction_sites_team_subtitle' );


if($construction_sites_enable_team_section==true ) {
    

        $construction_sites_teams_no        = 6;
        $construction_sites_teams_pages      = array();
        for( $i = 1; $i <= $construction_sites_teams_no; $i++ ) {
             $construction_sites_teams_pages[] = get_theme_mod('construction_sites_team_page'.$i);

        }
        $construction_sites_teams_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $construction_sites_teams_pages ),
        'posts_per_page' => absint($construction_sites_teams_no),
        'orderby' => 'post__in'
        ); 
        $construction_sites_teams_query = new WP_Query( $construction_sites_teams_args );
      

?>
<section class="traniner-two sp-100">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php if(!empty($construction_sites_team_title)) { ?>
        <div class="all-title">
          <h3 class="sec-title">
            <?php echo esc_html($construction_sites_team_title); ?>
          </h3>
          <p>
          <?php echo esc_html($construction_sites_team_subtitle); ?>
           </p>
        </div>
      <?php } ?>
      </div>
    </div>
    <div class="row">
      <div class="team-slider-two owl-carousel owl-theme">
        <?php
            $count = 0;
            while($construction_sites_teams_query->have_posts() && $count <= 6 ) :
            $construction_sites_teams_query->the_post();
         ?> 
        <div class="team-item team-two">
          <div class="team-det">
            <h5 class="mb-2">
              <?php the_title(); ?>
            </h5>
            <?php the_excerpt(); ?>
           
          </div>
          <?php if(has_post_thumbnail()): ?>
          <div class="team-img">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php endif; ?>
        </div>
        <?php
            $count = $count + 1;
            endwhile;
            wp_reset_postdata();
        ?> 
      </div>
    </div>
  </div>
</section>
<?php } ?>