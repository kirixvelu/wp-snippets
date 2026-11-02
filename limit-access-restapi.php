<?php
// Limit Access RestAPI
add_filter( 'rest_authentication_errors', function( $result ) {
    if ( true === $result || is_wp_error( $result ) ) {
        return $result;
    }

    if ( ! is_user_logged_in() ) {
        return new WP_Error(
            'rest_not_logged_in',
            'REST API access restricted.',
            array( 'status' => 401 )
        );
    }
    return $result;
} );
