<?php
// Remove Inline Font
add_action( 'wp_head', function () {
    ob_start( function ( $buffer ) {
        return preg_replace( '/<style[^>]*wp-fonts-local[^>]*>.*?<\/style>/s', '', $buffer ); // Default 2025 Theme Fonts
    } );
}, 49 );

add_action( 'wp_head', function () {
    ob_end_flush();
}, 51 );