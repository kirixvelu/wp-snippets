<?php
// Auto Image Meta / Kiri Vadivelu / 2026
add_action( 'add_attachment', 'auto_image_meta' ); // On upload

function auto_image_meta( $post_ID ) {
    if ( ! wp_attachment_is_image( $post_ID ) ) return;

    $title = get_post( $post_ID )->post_title;

    // Replace hyphens, underscores & extra spaces with a single space
    $title = preg_replace( '/\s*[-_\s]+\s*/', ' ', $title );

    // Capitalize first letter of each word
    $title = ucwords( strtolower( $title ) );

    // Update Title, Caption, Description
    wp_update_post( array(
        'ID'           => $post_ID,
        'post_title'   => $title,
        'post_excerpt' => $title,   // Caption
        //'post_content' => $title,   // Description
    ) );

    // Update Alt Text
    update_post_meta( $post_ID, '_wp_attachment_image_alt', $title );
}   