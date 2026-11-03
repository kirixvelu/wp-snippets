<?php
// Block Intense Query
function protect_expensive_endpoints() {
    $expensive_endpoints = [
        '/wp-admin/admin-ajax.php',
        '/wp-cron.php',
        '/?s=', // Search queries
    ];
    
    $request_uri = $_SERVER['REQUEST_URI'];
    
    foreach ($expensive_endpoints as $endpoint) {
        if (strpos($request_uri, $endpoint) !== false) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $key = 'expensive_' . md5($ip . $endpoint);
            
            if (get_transient($key) > 10) { // 10 requests per 5 minutes
                http_response_code(429);
                exit('Rate limit exceeded for resource-intensive operation');
            }
            
            set_transient($key, get_transient($key) + 1, 300);
        }
    }
}
add_action('init', 'protect_expensive_endpoints', 1);
