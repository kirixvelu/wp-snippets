<?php
// Remove Screen Option
add_filter( 'screen_options_show_screen', 'remove_screen_options' );   

function remove_screen_options() {
    // Check for admin capacity
    if ( current_user_can( 'manage_options' ) ) {
        return true; // Show Screen Options
    }
    return false; // Hide Screen Options
}

// Remove Admin Help
add_action( 'admin_head', 'remove_admin_help' );

function remove_admin_help() {
    $screen = get_current_screen();
    if ( $screen ) {
        $screen->remove_help_tabs();
    }
} 