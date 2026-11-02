<?php
// Limit image width
add_filter('wp_handle_upload_prefilter', 'image_max_pixel');
function image_max_pixel($file) {
    $image = getimagesize($file['tmp_name']);
    if ($image[0] > 5000 || $image[1] > 5000) {
        $file['error'] = 'Image too large (max 5000×5000).';
    }
    return $file;
}   