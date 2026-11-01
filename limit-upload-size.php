<?php
// Limit upload size
function max_upload_size( $file ) {
    $max = 9 * 1024 * 1024; // 9 MB
    if ( $file['size'] > $max ) {
        $file['error'] = 'File exceeds the 9 MB maximum upload size.';
    }
    return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'max_upload_size' );   