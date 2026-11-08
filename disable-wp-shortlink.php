<?php
// Disable WP Shortlink / Kiri Vadivelu / 2026
add_action( 'init', function () {
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
    remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
} );   