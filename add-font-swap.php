<?php
// Add Font Swap to Google Fonts
add_filter('style_loader_tag', 'add_font_display_swap', 10, 4);
function add_font_display_swap($html, $handle, $href, $media) {
    if (strpos($href, '//fonts.googleapis.com') !== false) {
        if (strpos($href, 'display=swap') === false) {
            $new_href = add_query_arg('display', 'swap', $href);
            $html = str_replace($href, esc_url($new_href), $html);
        }
    }
    return $html;
}   