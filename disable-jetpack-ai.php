<?php
// Disable Jetpack AI
add_filter( 'jetpack_ai_enabled', '__return_false' );   

// Remove Jetpack-AI Menu
add_action( 'admin_init', function() {
    remove_submenu_page( 'jetpack', 'jetpack-ai', 999 );
} );   