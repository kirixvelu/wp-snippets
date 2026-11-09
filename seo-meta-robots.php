<?php
// SEO Meta Robots / Kiri Vadivelu / 2026
add_filter( 'wp_robots', function( $robots ) {
    if ( ! is_singular( 'post' ) ) {
        $robots['noindex'] = true;
        $robots['nofollow'] = true;
    }
    return $robots;
} );   
