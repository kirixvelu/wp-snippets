<?php
// List WPTheme Styles
add_action( 'wp_enqueue_scripts', 'list_theme_css' );
function list_theme_css() {
    global $wp_styles;
    if ( is_a( $wp_styles, 'WP_Styles' ) ) {
        foreach ( $wp_styles->queue as $handle ) {
            echo $handle . ' => ' . $wp_styles->registered[$handle]->src . '<br>';
        }
    }
}  

// List WPTheme Scripts
add_action( 'wp_enqueue_scripts', 'list_theme_scripts' );
function list_theme_scripts() {
    global $wp_scripts;
    if ( is_a( $wp_scripts, 'WP_Scripts' ) ) {
        foreach ( $wp_scripts->queue as $handle ) {
            echo $handle . ' => ' . $wp_scripts->registered[$handle]->src . '<br>';
        }
    }
}   