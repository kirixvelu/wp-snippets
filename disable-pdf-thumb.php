<?php
// Disable PDF Thumbnail
function disable_pdf_previews() {
    $fallbacksizes = array();
    return $fallbacksizes;
}
add_filter('fallback_intermediate_image_sizes', 'disable_pdf_previews');   