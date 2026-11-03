<?php
// Block Remote Request
add_filter('xmlrpc_enabled', '__return_false');

// Remove RSD link
remove_action('wp_head', 'rsd_link');

// Block XML-RPC requests at server level
add_action('init', function() {
    if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST) {
        http_response_code(403);
        exit('XML-RPC disabled for security');
    }
});
