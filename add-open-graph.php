<?php
// Add open graph meta
function open_graph_meta() {
    if (is_singular()) {
        global $post;
        $title = get_the_title();
        $description = has_excerpt() ? get_the_excerpt() : wp_trim_words($post->post_content, 30);
        $url = get_permalink();
        $image = get_the_post_thumbnail_url($post->ID, 'large');
        $site_name = get_bloginfo('name');

        echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '" />' . "\n";
        if ($image) {
            echo '<meta property="og:image" content="' . esc_url($image) . '" />' . "\n";
        }
    } elseif (is_front_page()) {
        $site_name = get_bloginfo('name');
        $description = get_bloginfo('description');
        echo '<meta property="og:title" content="' . esc_attr($site_name) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
    }
}
add_action('wp_head', 'open_graph_meta');   