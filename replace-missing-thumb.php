<?php
// Replace Missing Thumbnail
function replace_missing_thumbnail( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    if ( empty( $html ) ) {
        // Replace with your site logo URL
        $logo_url = 'https://example.com/path/to/logo.png';
        $html = '<img src="' . esc_url( $logo_url ) . '" alt="Site Logo" />';
    }
    return $html;
}
add_filter( 'post_thumbnail_html', 'replace_missing_thumbnail', 10, 5 );   