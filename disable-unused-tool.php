<?php
// Disable Unused Tool
add_action('admin_menu', 'remove_import_export_tools');

function remove_import_export_tools() {
    remove_submenu_page('tools.php', 'import.php');
    remove_submenu_page('tools.php', 'export.php');
    remove_submenu_page('tools.php', 'tools.php');
}

add_action('admin_init', 'block_direct_tool_access');

function block_direct_tool_access() {
    global $pagenow;

    if (in_array($pagenow, array('import.php', 'export.php', 'tools.php'))) {
        // if (!is_super_admin()) { // optionally allow admins
            wp_redirect(admin_url('index.php'));
            exit;
        // }
    }
} 