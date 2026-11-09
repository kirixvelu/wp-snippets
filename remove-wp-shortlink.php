<?php
// Remove Wordpress Shortlink
add_action( 'init', function () {
    // Remove the <link rel='shortlink'> tag from the HTML head
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
    
    // Remove the Link: rel=shortlink HTTP response header
    // Note: Priority 11 is required to match the core hook
    remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
} );   