<?php
// Limit Jetpack Form
add_filter( 'jetpack_contact_form_is_spam', function ( $is_spam, $submission ) {
    $ip    = $_SERVER['REMOTE_ADDR'];
    $limit = 3; // Adjust accordingly
    $key   = 'jetpack_form_ip_' . md5( $ip );

    $count = get_transient( $key );
    if ( $count === false ) $count = 0;

    if ( $count >= $limit ) {
        // Block: return WP_Error to abort submission
        return new \WP_Error(
            'rate_limit',
            'Too many submissions from your IP. Please try again later.'
        );
    }

    set_transient( $key, $count + 1, HOUR_IN_SECONDS );
    return $is_spam; // pass through
}, 10, 2 );  