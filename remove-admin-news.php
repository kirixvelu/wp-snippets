<?php
// Remove admin dashboard news and events widget
add_action('wp_dashboard_setup', function() {
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
}); 