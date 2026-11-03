<?php
// Limit Remote Request
function xmlrpc_rate_limit($methods) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $current_count = get_transient('xmlrpc_limit_' . md5($ip));
    
    if ($current_count >= 5) { // 5 requests per hour
        status_header(429);
        exit('XML-RPC rate limit exceeded');
    }
    
    set_transient('xmlrpc_limit_' . md5($ip), $current_count + 1, HOUR_IN_SECONDS);
    return $methods;
}

add_filter('xmlrpc_methods', 'xmlrpc_rate_limit');
