<?php
// Allow Site Setting / Kiri Vadivelu / 2026
add_action( 'admin_init', 'remove_sensitive_setting', 999 );
function remove_sensitive_setting() {
    global $user_ID;
    if ( $user_ID != 1 ) { // ID number of allowed user
        // Primary Menus
        remove_menu_page( 'options-general.php' ); // Settings
        // Secondary Menus
        remove_submenu_page( 'themes.php', 'site-editor.php' ); // Site
    }
} 