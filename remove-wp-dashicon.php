<?php
// Remove Wordpress Dashicon
add_action( 'wp_enqueue_scripts', 'remove_dashicons_frontend' );
function remove_dashicons_frontend() {
    if ( ! is_user_logged_in() ) {
        wp_dequeue_style( 'dashicons' );
        wp_deregister_style( 'dashicons' );
    }
}   