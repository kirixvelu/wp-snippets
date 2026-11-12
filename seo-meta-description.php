<?php
// SEO Meta Description / Kiri Vadivelu / 2026
function seo_meta_desc() {
    if (is_singular()) {
        global $post;
        $description = get_post_meta($post->ID, 'meta_description', true);
        if (!$description) {
            $description = wp_strip_all_tags(get_the_excerpt($post));
        }
        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        }
    } elseif (is_front_page()) {
        echo '<meta name="description" content="' . esc_attr(get_bloginfo('description')) . '">' . "\n";
    }
}
add_action('wp_head', 'seo_meta_desc', 2);  