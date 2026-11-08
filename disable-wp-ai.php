<?php
// Disable WP AI / Kiri Vadivelu / 2026
add_filter( 'wp_supports_ai', '__return_false', 1000 );   

// Most reliable method via wp-config
// define( 'WP_AI_SUPPORT', false );   