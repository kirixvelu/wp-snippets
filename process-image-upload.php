<?php
// Process image upload
add_filter( 'wp_handle_upload', 'image_type_convert' );

function image_type_convert( $upload ) {
    // Only process images
    if ( ! isset( $upload['type'] ) || ! in_array( $upload['type'], [ 'image/jpeg', 'image/png', 'image/jpg' ], true ) ) {
        return $upload;
    }

    $file_path = $upload['file'];
    $webp_path = str_replace( [ '.jpg', '.jpeg', '.png' ], '.webp', $file_path );

    // Try Imagick first, then GD
    $converted = false;

    if ( class_exists( 'Imagick' ) ) {
        try {
            $imagick = new Imagick( $file_path );
            $imagick->setImageFormat( 'webp' );
            $imagick->writeImage( $webp_path );
            $imagick->clear();
            $imagick->destroy();
            $converted = true;
        } catch ( Exception $e ) {
            // Fallback to GD
        }
    }

    if ( ! $converted && function_exists( 'imagecreatefromjpeg' ) ) {
        $img = null;
        if ( $upload['type'] === 'image/jpeg' || $upload['type'] === 'image/jpg' ) {
            $img = imagecreatefromjpeg( $file_path );
        } elseif ( $upload['type'] === 'image/png' ) {
            $img = imagecreatefrompng( $file_path );
        }

        if ( $img ) {
            imagewebp( $img, $webp_path );
            imagedestroy( $img );
            $converted = true;
        }
    }

    if ( $converted && file_exists( $webp_path ) ) {
        // Delete the original file
        unlink( $file_path );

        // Update metadata to WebP file
        $upload['file'] = $webp_path;
        $upload['url']  = str_replace( basename( $upload['url'] ), basename( $webp_path ), $upload['url'] );
        $upload['type'] = 'image/webp';
    }

    return $upload;
}   