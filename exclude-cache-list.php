<?php
// Exclude cache based on URL terms
function exclude_cache_list() {
    // Array of slug fragments to exclude from cache
    $excluded_slugs = [
        '/red/',
        '/green/',
        '/blue/',
    ];

      // Ensure its a non-empty array
    if ( ! is_array( $excluded_slugs ) || empty( $excluded_slugs ) ) {
        return;
    }

    $uri = $_SERVER['REQUEST_URI'];

    foreach ( $excluded_slugs as $fragment ) {
        if ( str_contains( $uri, $fragment ) ) {
            if ( ! defined( 'DONOTCACHEPAGE' ) ) {
                define( 'DONOTCACHEPAGE', true );
            }
            return; // stop after first match
        }
    }
}
add_action( 'template_redirect', 'exclude_cache_list' ); 