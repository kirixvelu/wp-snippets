<?php
// Limit Nav Link / Kiri Vadivelu / 2026
add_filter( 'next_post_link', 'limit_nav_link_title', 10, 4 );
add_filter( 'previous_post_link', 'limit_nav_link_title', 10, 4 );

function limit_nav_link_title( $output, $format, $link, $post ) {
    if ( ! $post ) {
        return $output;
    }
    $max_chars = 30; // Adjust to n
    $title = $post->post_title;
    if ( strlen( $title ) > $max_chars ) {
        $title = substr( $title, 0, $max_chars ) . '…';
    }
    return str_replace( $post->post_title, $title, $output );
}