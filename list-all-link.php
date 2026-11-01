<?php
// List All URLs / Kiri Vadivelu / 2026
add_action('admin_menu', 'add_url_list_page');
function add_url_list_page() {
    add_management_page('All URLs', 'All URLs', 'manage_options', 'all-urls', 'display_all_urls');
}

function display_all_urls() {
    $args = array(
        'post_type' => array('post', 'page'),
        'post_status' => 'publish',
        'numberposts' => -1
    );
    $posts = get_posts($args);
    echo '<h2>All Published URLs</h2>';
    echo '<ol>';
    foreach ($posts as $post) {
        echo '<li><a href="' . get_permalink($post->ID) . '" target="_blank" rel="noopener noreferrer">' . get_the_title($post->ID) . '</a></li>';
    }
    echo '</ol>';
}   