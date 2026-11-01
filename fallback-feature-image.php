<?php
// Fallback feature image
add_filter( 'post_thumbnail_html', 'my_default_featured_image', 10, 5 );
function my_default_featured_image( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    // If no HTML is generated (no featured image set)
    if ( empty( $html ) ) {
        // Replace with your actual image URL
        $default_image_url = 'https://example.com/path/to/your-default-image.jpg';
        
        // Generate the HTML for the default image
        $html = sprintf(
            '<img src="%s" alt="Default Featured Image" class="wp-post-image" />',
            esc_url( $default_image_url )
        );
    }
    return $html;
}   