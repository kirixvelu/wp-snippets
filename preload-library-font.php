<?php
// Preload Library Font / Kiri Vadivelu / 2026
function preload_library_fonts() {
    $font_dir = wp_font_dir(); // returns array with 'path' and 'url'
    $base_url = $font_dir['url']; // e.g. https://yoursite.com/wp-content/uploads/fonts

    $fonts = array(
        $base_url . '/font-file-1.woff2',
        $base_url . '/font-file-2.woff2',
        $base_url . '/font-file-3.woff2',
        $base_url . '/font-file-4.woff2',
    );

    foreach ( $fonts as $font ) {
        echo '<link rel="preload" href="' . esc_url( $font ) . '" as="font" type="font/woff2" crossorigin="anonymous">' . "\n";
    }
}
add_action( 'wp_head', 'preload_library_fonts', 1 ); // Load priority 1 
