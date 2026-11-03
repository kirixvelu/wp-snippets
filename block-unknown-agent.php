<?php
// Block Unknown Agent
function flag_suspicious_user_agents() {
    // Leave the admin, cron and CLI alone
    if (is_admin() || wp_doing_cron() || (defined('WP_CLI') && WP_CLI)) {
        return;
    }
    
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $blocked_patterns = '/(python-requests|go-http-client|libwww-perl|scrapy|masscan|zgrab)/i';
    
    if ($ua === '' || preg_match($blocked_patterns, $ua)) {
        status_header(403);
        exit('Automated requests are not allowed');
    }
}
add_action('init', 'flag_suspicious_user_agents', 1);
