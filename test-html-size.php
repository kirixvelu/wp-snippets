<?php
// Page Size HTML
// Start our buffer at the beginning of template rendering
add_action( 'template_redirect', 'page_size_ob_start', 0 );
function page_size_ob_start() {
    if ( ! is_admin() && ! wp_doing_ajax() ) {
        ob_start();
    }
}

// At wp_footer (very late), read the size and output the comment
add_action( 'wp_footer', 'page_size_ob_display', 999 );
function page_size_ob_display() {
    if ( is_admin() || wp_doing_ajax() ) return;
    $size = ob_get_length();
    if ( $size !== false ) {
        echo "\n<!-- HTML Page Size: " . round( $size / 1024, 2 ) . " KB (" . $size . " bytes) -->\n";
    }
} 