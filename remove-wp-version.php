<?php
// Remove Wordpress Version
// Remove generator meta tag from HTML head
remove_action( 'wp_head', 'wp_generator' );

// Remove version from RSS/Atom feeds
add_filter( 'the_generator', '__return_empty_string' );

// Remove version query strings from CSS/JS files
add_filter( 'style_loader_src', 'remove_wp_version_from_assets', 9999 );
add_filter( 'script_loader_src', 'remove_wp_version_from_assets', 9999 );

function remove_wp_version_from_assets( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}   