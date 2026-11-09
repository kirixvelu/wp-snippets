<?php
// Show image meta
// 1. Add Columns to Media Library
function add_media_library_columns( $columns ) {
    $columns['media_format'] = 'Format';
    $columns['dimensions']   = 'Dimensions';
    $columns['file_size']    = 'File Size';
    return $columns;
}
add_filter( 'manage_media_columns', 'add_media_library_columns' );

// 2. Display Data in Columns
function display_media_library_column_data( $column_name, $post_id ) {
    switch ( $column_name ) {
        case 'media_format':
            echo esc_html( get_post_mime_type( $post_id ) );
            break;
        case 'dimensions':
            $meta = wp_get_attachment_metadata( $post_id );
            if ( isset( $meta['width'] ) && isset( $meta['height'] ) ) {
                echo esc_html( $meta['width'] . ' x ' . $meta['height'] );
            } else {
                echo 'N/A';
            }
            break;
        case 'file_size':
            $file_path = get_attached_file( $post_id );
            if ( file_exists( $file_path ) ) {
                $bytes = filesize( $file_path );
                echo esc_html( size_format( $bytes, 2 ) );
            } else {
                echo 'N/A';
            }
            break;
    }
}
add_action( 'manage_media_custom_column', 'display_media_library_column_data', 10, 2 );

// 3. Optional: Adjust Column Widths for Better Display
function adjust_media_library_column_widths() {
    echo '<style>
        .column-media_format { width: 10%; }
        .column-dimensions { width: 15%; }
        .column-file_size { width: 10%; }
    </style>';
}
add_action( 'admin_head-upload.php', 'adjust_media_library_column_widths' );   