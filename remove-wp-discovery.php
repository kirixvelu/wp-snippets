<?php
// Remove Wordpress Discovery
// Remove the REST API link from the HTML head
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Remove the REST API link from XML-RPC responses
remove_action('xmlrpc_rpc_methods', 'rest_output_link_wp_head');

// Remove the Link header from HTTP responses
remove_action('template_redirect', 'rest_output_link_header', 11);   

// Disable oEmbed Discovery Links
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// Remove RSD link (used by old XML-RPC clients)
remove_action('wp_head', 'rsd_link');   