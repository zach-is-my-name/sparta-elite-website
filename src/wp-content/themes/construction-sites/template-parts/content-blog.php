<?php
/**
 * Template part for displaying section of blog content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @subpackage Construction Sites
 * @since 1.0
 */

$construction_sites_enable_blog_section = get_theme_mod( 'construction_sites_enable_blog_section', true );
$construction_sites_blog_cat 		= get_theme_mod( 'construction_sites_blog_cat', 'uncategorized' );
if($construction_sites_enable_blog_section == true) {
	

$construction_sites_blog_title 		= get_theme_mod( 'construction_sites_blog_title', __( 'Latest News', 'construction-sites' ) );
$construction_sites_blog_count 		= apply_filters( 'construction_sites_blog_count', 6 );

?>


<section class="blog sp-100">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="all-title">
					<?php
				if( !empty( $construction_sites_blog_title ) ) {
			?>
					<h3 class="sec-title">
						<?php echo esc_html( $construction_sites_blog_title ); ?>
					</h3>
				<?php } ?>
				</div>
			</div>
		</div>     
		<div class="blog-slider owl-carousel owl-theme owl-loaded owl-drag">
	<?php
					
					if( !empty( $construction_sites_blog_cat ) ) {
						$blog_args = array(
								'post_type' 	 => 'post',
								'category_name'	 => esc_attr( $construction_sites_blog_cat ),
								'posts_per_page' => absint( $construction_sites_blog_count ),
							);

							$blog_query = new WP_Query( $blog_args );
							if( $blog_query->have_posts() ) {
								while( $blog_query->have_posts() ) {
									$blog_query->the_post();
										?>
			<article class="blog-item blog-1">
					<?php if( has_post_thumbnail() ) { ?>
				<div class="post-img">
					<?php the_post_thumbnail(); ?>
						<div class="date">
							 <?php construction_sites_posted_on(); ?>
						</div>
				</div>
			<?php } ?>
				<ul class="post-meta">
						<?php construction_sites_posted_by(); 
					construction_sites_post_comments();?>
										</ul>
				<div class="post-content pt-4">
					<h5>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?>						</a>
					</h5>
                     
				</div>
			</article>
		 <?php
							}
						}
						wp_reset_postdata();
					}
				?>
		</div>

	</div>
</section>

<?php } ?>