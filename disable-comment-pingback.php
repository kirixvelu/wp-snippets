<?php
// Disable Comment Pingback / Kiri Vadivelu / 2026
// Close comments and pingbacks on the front end (overrides per-post settings)
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open',    '__return_false', 20, 2 );

// Remove comment/trackback support from all post types (hides admin UI)
add_action( 'admin_init', function () {
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
} );

// Stop sending pingbacks to other blogs
add_filter( 'pre_ping', function ( $links ) {
    return [];
} );   

add_filter( 'comments_array', '__return_empty_array', 10, 2 );   

add_action( 'admin_menu', function () {
    remove_menu_page( 'edit-comments.php' );
} );   