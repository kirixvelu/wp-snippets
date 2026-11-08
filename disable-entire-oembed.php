<?php
// Disable entire oEmbed / Kiri Vadivelu / 2026
add_action('init', 'disable_oembed_completely');
function disable_oembed_completely() {
    // Remove oEmbed discovery links
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 4);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    
    // Remove oEmbed-specific JavaScript
    remove_action('wp_head', 'wp_oembed_add_host_js');
    
    // Disable the oEmbed REST API route
    remove_action('rest_api_init', 'wp_oembed_register_route');
    
    // Turn off oEmbed auto discovery
    add_filter('embed_oembed_discover', '__return_false');
    
    // Remove embed rewrite rules
    add_filter('rewrite_rules_array', function($rules) {
        foreach($rules as $rule => $rewrite) {
            if(false !== strpos($rewrite, 'embed=true')) {
                unset($rules[$rule]);
            }
        }
        return $rules;
    });
}   