<?php
// Disable Site Editor / Kiri Vadivelu / 2026
add_action( 'admin_menu', function() {
    remove_submenu_page( 'themes.php', 'site-editor.php' );
} );   

add_action( 'load-site-editor.php', function() {
    wp_safe_redirect( get_dashboard_url() );
    exit();
} );   
 