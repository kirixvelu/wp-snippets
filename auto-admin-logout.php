<?php
// Auto Admin Logout
add_filter( 'auth_cookie_expiration', 'short_session_admin', 10, 3 );
function short_session_admin( $expiration, $user_id, $remember ) {
    // Only apply the short timeout for administrators
    if ( user_can( $user_id, 'manage_options' ) ) {
        return 3600; // 1 hour in seconds for admins only
    }
    // All other roles keep the default expiration
    return $expiration;
}  