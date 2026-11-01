<?php
// Redirect User Login 
function advanced_login_redirect( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        // Role based user redirect
        if ( in_array( 'member', $user->roles ) ) {
            return home_url( '/members-posts/' );
        }
        // Add more roles as needed
        if ( in_array( 'subscriber', $user->roles ) ) {
            return home_url( '/subscribers-posts/' );
        }
    }
    return $redirect_to;
}
add_filter( 'login_redirect', 'advanced_login_redirect', 10, 3 );   