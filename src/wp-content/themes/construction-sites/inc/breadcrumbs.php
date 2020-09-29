<?php
function construction_sites_breadcrumbs() {

       $construction_sites_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $construction_sites_showcurrent = 1;
    if (is_home() || is_front_page()) {

            echo '<ul id="breadcrumbs" class="banner-link text-center"><li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'construction-sites') . '</a></li></ul>';
    } else {

        echo '<ul id="breadcrumbs" class="banner-link text-center"><li><a href="' . esc_url(home_url('/')). '">' . esc_html__('Home', 'construction-sites') . '</a> ';
        if (is_category()) {
            $construction_sites_thisCat = get_category(get_query_var('cat'), false);
            if ($construction_sites_thisCat->parent != 0)
                echo esc_html(get_category_parents($construction_sites_thisCat->parent, TRUE, ' '));
            echo  esc_html__('Archive by category', 'construction-sites') . ' " ' . single_cat_title('', false) . ' "';
        }   elseif (is_search()) {
            echo  esc_html__('Search Results For ', 'construction-sites') . ' " ' . get_search_query() . ' "';
        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ';
            echo '<a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . esc_html(get_the_time('F') ). '</a> ';
            echo  esc_html(get_the_time('d'));
        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ';
            echo  esc_html(get_the_time('F')) ;
        } elseif (is_year()) {
            echo esc_html(get_the_time('Y')) ;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $construction_sites_post_type = get_post_type_object(get_post_type());
                $construction_sites_slug = $construction_sites_post_type->rewrite;
                echo '<a href="' . esc_url(home_url('/'. $construction_sites_slug['slug'] . '/')) .'">' . esc_html($construction_sites_post_type->labels->singular_name) . '</a>';
                if ($construction_sites_showcurrent == 1)
                    echo  esc_html(get_the_title()) ;
            } else {
                $construction_sites_cat = get_the_category();
                $construction_sites_cat = $construction_sites_cat[0];
                $construction_sites_cats = get_category_parents($construction_sites_cat, TRUE, ' ');
                if ($construction_sites_showcurrent == 0)
                    $construction_sites_cats =
                            preg_replace("#^(.+)\s\s$#", "$1", $construction_sites_cats);
                echo $construction_sites_cats;
                if ($construction_sites_showcurrent == 1)
                    echo  esc_html(get_the_title());
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $construction_sites_post_type = get_post_type_object(get_post_type());
            echo esc_html($construction_sites_post_type->labels->singular_name );
        } elseif (is_page()) {
            if ($construction_sites_showcurrent == 1)
                echo esc_html(get_the_title());
        } elseif (is_page() && $post->post_parent) {
            $construction_sites_parent_id = $post->post_parent;
            $construction_sites_breadcrumbs = array();
            while ($construction_sites_parent_id) {
                $construction_sites_page = get_page($construction_sites_parent_id);
                $construction_sites_breadcrumbs[] = '<a href="' . esc_url(get_permalink($construction_sites_page->ID)) . '">' . esc_html(get_the_title($construction_sites_page->ID)) . '</a>';
                $construction_sites_parent_id = $construction_sites_page->post_parent;
            }
            $construction_sites_breadcrumbs = array_reverse($construction_sites_breadcrumbs);
            for ($construction_sites_i = 0; $construction_sites_i < count($construction_sites_breadcrumbs); $construction_sites_i++) {
                echo $construction_sites_breadcrumbs[$construction_sites_i];
                if ($construction_sites_i != count($construction_sites_breadcrumbs) - 1)
                    echo ' ';
            }
            if ($construction_sites_showcurrent == 1)
                echo esc_html(get_the_title());
        } elseif (is_tag()) {
            echo  esc_html__('Posts tagged', 'construction-sites') . ' " ' . esc_html(single_tag_title('', false)) . ' "';
        } elseif (is_author()) {
            global $author;
            $construction_sites_userdata = get_userdata($author);
            echo  esc_html__('Articles Published by', 'construction-sites') . ' " ' . esc_html($construction_sites_userdata->display_name ). ' "';
        } elseif (is_404()) {
            echo esc_html__('Error 404', 'construction-sites') ;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            printf( /* translators: %s is search query variable*/ esc_html__(' ( Page %s )', 'construction-sites'),esc_html(get_query_var('paged')) );
        }

        
        echo '</li></ul>';
    }
}