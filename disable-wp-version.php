<?php
// Disable WP Version / Kiri Vadivelu / 2026
function disable_wp_version() {
    return '';
}
add_filter( 'the_generator', 'disable_wp_version' );
remove_action( 'wp_head', 'wp_generator' );   