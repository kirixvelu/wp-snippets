<?php
// Disable Sharing Submenu
// Remove Sharing from Settings submenu
add_action('admin_menu', function () {
    remove_submenu_page('options-general.php', 'sharing');
});

// Block direct URL access
add_action('admin_init', function () {
    if (isset($_GET['page']) && $_GET['page'] === 'sharing') {
        wp_safe_redirect(admin_url('options-general.php'));
        exit;
    }
});  