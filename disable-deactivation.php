<?php   
// Disable deactivation
add_filter( 'plugin_action_links', 'disable_all_plugin_deactivation', 10, 4 );
function disable_all_plugin_deactivation( $actions, $plugin_file, $plugin_data, $context ) {
    if ( get_current_user_id() !== 1 ) { // Replace 1 with your admin user ID
        unset( $actions['deactivate'] );
    }
    return $actions;
}   