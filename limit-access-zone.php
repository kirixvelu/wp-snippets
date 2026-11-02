<?php
// Limit Access Zone
add_action( 'admin_init', 'limit_access_zone' ); 

function limit_access_zone() {
    // Check if user is trying to access admin area
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        $user = wp_get_current_user();
        
        // Check for Subscriber or Contributor roles
        if ( in_array( 'subscriber', (array) $user->roles ) || 
             in_array( 'contributor', (array) $user->roles ) ) {
            wp_redirect( home_url() );
            exit;
        }
    }
}
