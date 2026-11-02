<?php
// Minify WP HTML
add_action('template_redirect', 'wp_html_minify_start');

function wp_html_minify_start() {
    // Only minify for front-end HTML pages
    if (is_user_logged_in() || !is_singular() && !is_home() && !is_front_page()) return;
    
    ob_start('wp_html_minify_finish');
}

function wp_html_minify_finish($html) {
    $original = $html;
    
    // Remove HTML comments 
    $html = preg_replace('/<!--(?!\[if).*?-->/s', '', $html);
    
    // Remove whitespace between tags
    $html = preg_replace('/>\s+</', '><', $html);
    
    // Remove newlines and tabs
    $html = str_replace(array("\r\n", "\r", "\n", "\t"), '', $html);
    
    // Collapse multiple spaces
    while (stristr($html, '  '))
        $html = str_replace('  ', ' ', $html);
    
    // Show compression stats (remove in production)
    $saved = strlen($original) - strlen($html);
    $html .= "\n<!-- Minified: saved " . $saved . " bytes -->";
    
    return $html;
}   