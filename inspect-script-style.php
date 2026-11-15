<?php
// Inspect Script Style / Kiri Vadivelu / 2026
function inspect_script_style() {
    global $wp_scripts, $wp_styles;
    echo "\n" . '<!-- (Script IDs | Style IDs) ' . 
         implode(', ', $wp_scripts->queue) . ' | ' . 
         implode(', ', $wp_styles->queue) . " -->\n";
}
add_action('wp_print_scripts', 'inspect_script_style');     