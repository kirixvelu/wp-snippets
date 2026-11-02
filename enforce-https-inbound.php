<?php
// Enforce HTTPS for Incoming REST API
add_filter('rest_authentication_errors', function($result) {
    // If already authenticated or error, pass through
    if (true === $result || is_wp_error($result)) {
        return $result;
    }

    // Check if request is HTTPS
    if (!is_ssl()) {
        return new WP_Error(
            'rest_not_logged_in',
            'HTTPS is required.',
            array('status' => 403)
        );
    }

    // Require authentication for all REST API calls
    if (!is_user_logged_in()) {
        return new WP_Error(
            'rest_not_logged_in',
            'Authentication required.',
            array('status' => 401)
        );
    }

    return $result;
});   