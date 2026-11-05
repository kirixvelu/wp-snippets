<?php
// Enable Future Post / Kiri Vadivelu / 2026
function publish_future_type( $post_data ) {
    if ( $post_data['post_status'] == 'future' && $post_data['post_type'] == 'post' ) {
        $post_data['post_status'] = 'publish';
    }
    return $post_data;
}
add_filter('wp_insert_post_data', 'publish_future_type');
// Remove the automatic future hook
remove_action('future_post', '_future_post_hook');  
