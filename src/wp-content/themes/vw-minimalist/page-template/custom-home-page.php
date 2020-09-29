<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent" role="main">  
  <?php do_action( 'vw_minimalist_before_slider' ); ?>

  <?php if( get_theme_mod('vw_minimalist_slider_arrows') != ''){ ?>
    <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="<?php echo esc_attr(get_theme_mod( 'vw_minimalist_slider_speed',3000)) ?>"> 
        <?php $vw_minimalist_pages = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'vw_minimalist_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $vw_minimalist_pages[] = $mod;
            }
          }
          if( !empty($vw_minimalist_pages) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $vw_minimalist_pages,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <div class="container">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <div class="carousel-caption">
                    <div class="inner_carousel">
                      <h1><?php the_title(); ?></h1>
                      <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_minimalist_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_minimalist_slider_excerpt_number','20')))); ?></p>
                    </div>
                    <?php if( get_theme_mod('vw_minimalist_slider_button_text','MORE ABOUT US') != ''){ ?>
                      <div class="read-btn">
                        <a href="<?php the_permalink();?>" title="<?php esc_attr_e( 'MORE ABOUT US', 'vw-minimalist' ); ?>"><?php echo esc_html(get_theme_mod('vw_minimalist_slider_button_text',__('MORE ABOUT US','vw-minimalist')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_minimalist_slider_button_text',__('MORE ABOUT US','vw-minimalist')));?></span></a>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 slider-image-box">
                  <div class="slider-img"></div>
                  <a href="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>
                </div>
              </div>
            </div>
          </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','vw-minimalist' );?></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','vw-minimalist' );?></span>
        </a>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <?php do_action( 'vw_minimalist_after_slider' ); ?>

  <?php if( get_theme_mod('vw_minimalist_services_category') != '' ){ ?>

  <section id="services-sec">
    <div class="container">
      <div class="heading-text">        
        <?php if( get_theme_mod( 'vw_minimalist_section_text') != '') { ?>
          <p class="sec-text"><?php echo esc_html(get_theme_mod('vw_minimalist_section_text',''));?></p>
        <?php } ?>
        <?php if( get_theme_mod( 'vw_minimalist_section_title') != '') { ?>
          <h2><?php echo esc_html(get_theme_mod('vw_minimalist_section_title',''));?></h2>
        <?php } ?>
      </div>
      <div class="row">
        <?php 
        $vw_minimalist_catData=  get_theme_mod('vw_minimalist_services_category');
          if($vw_minimalist_catData){
            $page_query = new WP_Query(array( 'category_name' => esc_html( $vw_minimalist_catData ,'vw-minimalist')));?>
              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                <div class="col-lg-4 col-md-4">
                  <div class="inner-box">
                    <?php the_post_thumbnail(); ?>
                    <h3><a href="<?php the_permalink();?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h3>
                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_minimalist_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_minimalist_services_excerpt_number','20')))); ?></p>
                    <div class="read-more-arrow"><a href="<?php the_permalink(); ?>"><i class="fas fa-arrow-right"></i></a></div>
                  </div>
                </div>
              <?php endwhile;
            wp_reset_postdata();
          } ?>
      </div>
    </div>
  </section>

  <?php }?>

  <?php do_action( 'vw_minimalist_after_service' ); ?>

  <div id="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>

</main>

<?php get_footer(); ?>