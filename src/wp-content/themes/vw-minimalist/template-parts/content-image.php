<?php
/**
 * The template part for displaying post
 *
 * @package VW Minimalist 
 * @subpackage vw-minimalist
 * @since vw-minimalist 1.0
 */
?>

<?php 
  $vw_minimalist_archive_year  = get_the_time('Y'); 
  $vw_minimalist_archive_month = get_the_time('m'); 
  $vw_minimalist_archive_day   = get_the_time('d'); 
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="post-main-box">
    <?php $vw_minimalist_theme_lay = get_theme_mod( 'vw_minimalist_blog_layout_option','Default');
    if($vw_minimalist_theme_lay == 'Default'){ ?>
      <div class="row">
        <?php if(has_post_thumbnail()) {?>
          <div class="box-image col-lg-6 col-md-6">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php } ?>
        <article class="new-text <?php if(has_post_thumbnail()) { ?>col-lg-6 col-md-6" <?php } else { ?>col-lg-12 col-md-12" <?php } ?>>
          <h2 class="section-title"><a href="<?php the_permalink(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
          <?php if( get_theme_mod( 'vw_minimalist_toggle_postdate',true) != '' || get_theme_mod( 'vw_minimalist_toggle_author',true) != '' || get_theme_mod( 'vw_minimalist_toggle_comments',true) != '') { ?>
            <div class="post-info">
              <?php if(get_theme_mod('vw_minimalist_toggle_postdate',true)==1){ ?>
                <span class="entry-date"><a href="<?php echo esc_url( get_day_link( $vw_minimalist_archive_year, $vw_minimalist_archive_month, $vw_minimalist_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span>|</span>
              <?php } ?>

              <?php if(get_theme_mod('vw_minimalist_toggle_author',true)==1){ ?>
                <span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span><span>|</span>
              <?php } ?>

              <?php if(get_theme_mod('vw_minimalist_toggle_comments',true)==1){ ?>
                <span class="entry-comments"><?php comments_number( __('0 Comment', 'vw-minimalist'), __('0 Comments', 'vw-minimalist'), __('% Comments', 'vw-minimalist') ); ?></span>
              <?php } ?>
            </div>
          <?php } ?>
          <p>
            <?php $vw_minimalist_theme_lay = get_theme_mod( 'vw_minimalist_excerpt_settings','Excerpt');
            if($vw_minimalist_theme_lay == 'Content'){ ?>
              <?php the_content(); ?>
            <?php }
            if($vw_minimalist_theme_lay == 'Excerpt'){ ?>
              <?php if(get_the_excerpt()) { ?>
                <?php $excerpt = get_the_excerpt(); echo esc_html( vw_minimalist_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_minimalist_excerpt_number','30')))); ?> <?php echo esc_html(get_theme_mod('vw_minimalist_excerpt_suffix',''));?>
              <?php }?>
            <?php }?>
          </p>
          <?php if( get_theme_mod('vw_minimalist_button_text','READ MORE') != ''){ ?>
            <div class="more-btn">
              <a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('vw_minimalist_button_text',__('READ MORE','vw-minimalist')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_minimalist_button_text',__('READ MORE','vw-minimalist')));?></span></a>
            </div>
          <?php } ?>
        </article>
      </div>
    <?php }else if($vw_minimalist_theme_lay == 'Center'){ ?>
      <div class="service-text">
        <h2 class="section-title"><a href="<?php the_permalink(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
        <div class="box-image">
          <?php the_post_thumbnail(); ?>
        </div>
        <?php if( get_theme_mod( 'vw_minimalist_toggle_postdate',true) != '' || get_theme_mod( 'vw_minimalist_toggle_author',true) != '' || get_theme_mod( 'vw_minimalist_toggle_comments',true) != '') { ?>
          <div class="post-info">
            <?php if(get_theme_mod('vw_minimalist_toggle_postdate',true)==1){ ?>
              <span class="entry-date"><a href="<?php echo esc_url( get_day_link( $vw_minimalist_archive_year, $vw_minimalist_archive_month, $vw_minimalist_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span>|</span>
            <?php } ?>

            <?php if(get_theme_mod('vw_minimalist_toggle_author',true)==1){ ?>
              <span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span><span>|</span>
            <?php } ?>

            <?php if(get_theme_mod('vw_minimalist_toggle_comments',true)==1){ ?>
              <span class="entry-comments"><?php comments_number( __('0 Comment', 'vw-minimalist'), __('0 Comments', 'vw-minimalist'), __('% Comments', 'vw-minimalist') ); ?></span>
            <?php } ?>
          </div>
        <?php } ?>
        <p>
          <?php $vw_minimalist_theme_lay = get_theme_mod( 'vw_minimalist_excerpt_settings','Excerpt');
          if($vw_minimalist_theme_lay == 'Content'){ ?>
            <?php the_content(); ?>
          <?php }
          if($vw_minimalist_theme_lay == 'Excerpt'){ ?>
            <?php if(get_the_excerpt()) { ?>
              <?php $excerpt = get_the_excerpt(); echo esc_html( vw_minimalist_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_minimalist_excerpt_number','30')))); ?> <?php echo esc_html(get_theme_mod('vw_minimalist_excerpt_suffix',''));?>
            <?php }?>
          <?php }?>
        </p>
        <?php if( get_theme_mod('vw_minimalist_button_text','READ MORE') != ''){ ?>
          <div class="more-btn">
            <a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('vw_minimalist_button_text',__('READ MORE','vw-minimalist')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_minimalist_button_text',__('READ MORE','vw-minimalist')));?></span></a>
          </div>
        <?php } ?>
      </div>
    <?php }else if($vw_minimalist_theme_lay == 'Left'){ ?>
      <div class="service-text">
        <div class="box-image">
          <?php the_post_thumbnail(); ?>
        </div>
        <h2 class="section-title"><a href="<?php the_permalink(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
        <?php if( get_theme_mod( 'vw_minimalist_toggle_postdate',true) != '' || get_theme_mod( 'vw_minimalist_toggle_author',true) != '' || get_theme_mod( 'vw_minimalist_toggle_comments',true) != '') { ?>
          <div class="post-info">
            <?php if(get_theme_mod('vw_minimalist_toggle_postdate',true)==1){ ?>
              <span class="entry-date"><a href="<?php echo esc_url( get_day_link( $vw_minimalist_archive_year, $vw_minimalist_archive_month, $vw_minimalist_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span>|</span>
            <?php } ?>

            <?php if(get_theme_mod('vw_minimalist_toggle_author',true)==1){ ?>
              <span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span><span>|</span>
            <?php } ?>

            <?php if(get_theme_mod('vw_minimalist_toggle_comments',true)==1){ ?>
              <span class="entry-comments"><?php comments_number( __('0 Comment', 'vw-minimalist'), __('0 Comments', 'vw-minimalist'), __('% Comments', 'vw-minimalist') ); ?></span>
            <?php } ?>
          </div>
        <?php } ?>
        <p>
          <?php $vw_minimalist_theme_lay = get_theme_mod( 'vw_minimalist_excerpt_settings','Excerpt');
          if($vw_minimalist_theme_lay == 'Content'){ ?>
            <?php the_content(); ?>
          <?php }
          if($vw_minimalist_theme_lay == 'Excerpt'){ ?>
            <?php if(get_the_excerpt()) { ?>
              <?php $excerpt = get_the_excerpt(); echo esc_html( vw_minimalist_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_minimalist_excerpt_number','30')))); ?> <?php echo esc_html(get_theme_mod('vw_minimalist_excerpt_suffix',''));?>
            <?php }?>
          <?php }?>
        </p>
        <?php if( get_theme_mod('vw_minimalist_button_text','READ MORE') != ''){ ?>
          <div class="more-btn">
            <a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('vw_minimalist_button_text',__('READ MORE','vw-minimalist')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_minimalist_button_text',__('READ MORE','vw-minimalist')));?></span></a>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>