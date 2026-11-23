<?php
// Auto Fix Image / Kiri Vadivelu / 2026
// Run once to fix existing image metadata
function bulk_fix_alt() {
    if ( get_option( 'alt_text_bulk_done' ) ) return; // already ran

    $args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => -1,
    );
    $images = get_posts( $args );

    foreach ( $images as $img ) {
        $existing = get_post_meta( $img->ID, '_wp_attachment_image_alt', true );
        if ( ! empty( $existing ) ) continue;

        $title = preg_replace( '/\s*[-_\s]+\s*/', ' ', $img->post_title );
        $title = ucwords( strtolower( $title ) );

        update_post_meta( $img->ID, '_wp_attachment_image_alt', $title );
    }

    update_option( 'alt_text_bulk_done', '1' );
}
add_action( 'admin_init', 'bulk_fix_alt' );   