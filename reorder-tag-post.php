<?php
// Reorder tagged post in archive list
add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && is_tag()) {
        $sticky_posts = get_option('sticky_posts');
        if (!empty($sticky_posts)) {
            add_filter('posts_orderby', function($orderby, $query) use ($sticky_posts) {
                if (!is_admin() && $query->is_main_query() && is_tag()) {
                    global $wpdb;
                    $sticky_list = implode(',', array_map('intval', $sticky_posts));
                    return "FIELD({$wpdb->posts}.ID, {$sticky_list}) DESC, {$orderby}";
                }
                return $orderby;
            }, 10, 2);
        }
    }
});
