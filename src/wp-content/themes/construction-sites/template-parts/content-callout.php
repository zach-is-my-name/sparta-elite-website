<?php
$construction_sites_enable_callout_section = get_theme_mod( 'construction_sites_enable_callout_section', true );
$construction_sites_callout_image = get_theme_mod( 'construction_sites_callout_image' );

if($construction_sites_enable_callout_section == true ) {
   
$construction_sites_callout_title = get_theme_mod( 'construction_sites_callout_title');
$construction_sites_callout_content = get_theme_mod( 'construction_sites_callout_content');
$construction_sites_callout_button_label1 = get_theme_mod( 'construction_sites_callout_button_label1');
$construction_sites_callout_button_link1 = get_theme_mod( 'construction_sites_callout_button_link1');


?>
    <section class="cta" style="background-image: url(<?php echo esc_url($construction_sites_callout_image); ?>);">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 text-lg-left text-center">
                    <h3 class="c-white text-capitalize"><?php echo esc_html($construction_sites_callout_title); ?></h3>
                    <p class="c-white mb-0"><?php echo esc_html($construction_sites_callout_content); ?></p>
                </div>
                <?php if(!empty($construction_sites_callout_button_label1 && $construction_sites_callout_button_link1)): ?>
                <div class="col-lg-3 text-lg-right text-center">
                    <a href="<?php echo esc_url($construction_sites_callout_button_link1); ?>" class="btn btn-two mt-3"><?php echo esc_html($construction_sites_callout_button_label1); ?></a>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </section>
<?php } ?>