<?php
// Remove Screen Option
function remove_screen_options() {
    // Check for admin capacity
    if ( current_user_can( 'manage_options' ) ) {
        return true; // Show Screen Options
    }
    return false; // Hide Screen Options
}
add_filter( 'screen_options_show_screen', 'remove_screen_options' );   