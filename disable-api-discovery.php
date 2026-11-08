<?php
// Disable API Discovery / Kiri Vadivelu / 2026
// Remove REST API links from HTML header
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

// Remove REST API link from HTTP headers
remove_action( 'template_redirect', 'rest_output_link_header', 11 );   