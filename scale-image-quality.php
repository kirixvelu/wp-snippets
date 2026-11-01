<?php
// Image Quality Scale
function image_quality_scale( $quality, $mime_type ) {
  if ( 'image/webp' === $mime_type ) {
     return 70; // Webp default 86
  }
  return $quality;
}
add_filter( 'wp_editor_set_quality', 'image_quality_scale', 10, 2 );   