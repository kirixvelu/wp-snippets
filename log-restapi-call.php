<?php
// Log Rest API Call (For Testing Only)
add_filter( 'rest_pre_dispatch', function( $result, $server, $request ) {
    if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
        error_log( sprintf(
            'REST API: %s %s (user: %d)',
            $request->get_method(),
            $request->get_route(),
            get_current_user_id()
        ) );
    }
    return $result;
}, 10, 3 );