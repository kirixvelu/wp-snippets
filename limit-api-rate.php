<?php
// Limit API Rate
// Hourly limits per route group
function get_endpoint_limit($route) {
    $limits = array(
        '/wp/v2/users' => 60,
        '/wp/v2/media' => 120,
        '/wp/v2/posts' => 240,
    );
    
    foreach ($limits as $prefix => $limit) {
        if (str_starts_with($route, $prefix)) {
            return array($prefix, $limit);
        }
    }
    
    return array('default', 1000);
}

// rest_pre_dispatch passes ($result, $server, $request) and expects $result back
function custom_api_rate_limit($result, $server, $request) {
    if (null !== $result) {
        return $result; // another filter already handled this request
    }
    
    $ip = $_SERVER['REMOTE_ADDR'];
    
    // Count per route group, so /users/1, /users/2... share one counter
    [$group, $limit] = get_endpoint_limit($request->get_route());
    $key = 'api_limit_' . md5($ip . $group);
    
    // Check current request count
    $current_count = (int) get_transient($key);
    
    if ($current_count >= $limit) {
        return new WP_Error(
            'rate_limit_exceeded',
            'Rate limit exceeded. Try again later.',
            array('status' => 429)
        );
    }
    
    // Increment counter
    set_transient($key, $current_count + 1, HOUR_IN_SECONDS);
    
    // Returning null lets WordPress dispatch the request normally
    return $result;
}

add_filter('rest_pre_dispatch', 'custom_api_rate_limit', 10, 3);
