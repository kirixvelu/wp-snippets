<?php
// Enforce HTTP HTTPS
add_action('template_redirect', function() {
    if ( ! is_ssl() ) {
        wp_safe_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 301);
        exit;
    }
});   