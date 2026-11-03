<?php
// Block Login IP
function handle_failed_login($username) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $attempts_key = 'login_attempts_' . md5($ip);
    $blocked_key = 'blocked_ip_' . md5($ip);
    
    // Increment failed attempts
    $attempts = get_transient($attempts_key) ?: 0;
    $attempts++;
    set_transient($attempts_key, $attempts, HOUR_IN_SECONDS);
    
    // Block IP after 5 failed attempts
    if ($attempts >= 5) {
        set_transient($blocked_key, time(), DAY_IN_SECONDS);
        
        // Log the block
        error_log("IP blocked for excessive login attempts: {$ip}");
        
        // Optional: Send notification
        wp_mail(
            get_option('admin_email'),
            'IP Blocked - Excessive Login Attempts',
            "IP {$ip} has been blocked for 24 hours due to {$attempts} failed login attempts."
        );
    }
}

add_action('wp_login_failed', 'handle_failed_login');

// Check for blocked IPs
function check_blocked_ip() {
    if (strpos($_SERVER['REQUEST_URI'], 'wp-login') !== false || 
        strpos($_SERVER['REQUEST_URI'], 'wp-admin') !== false) {
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $blocked_key = 'blocked_ip_' . md5($ip);
        
        if (get_transient($blocked_key)) {
            http_response_code(403);
            exit('IP temporarily blocked due to suspicious activity');
        }
    }
}
add_action('init', 'check_blocked_ip', 1);
