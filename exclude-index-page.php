<?php
// Exclude Indexing Pages
add_filter( 'wp_robots', function( $robots ) {
    if ( is_page() ) {
        $robots['index'] = 'noindex';
    }
    return $robots;
} );   
