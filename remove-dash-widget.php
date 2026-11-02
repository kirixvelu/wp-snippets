<?php
// Remove Dashboard Widget
function remove_dashboard_widget() {
    if ( ! current_user_can( 'manage_options' ) ) {
        
    // Remove WordPress Events and News
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    
    // Remove Site Health Status
    remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
    
    // Remove Activity/At a Glance
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    
    // Remove Quick Draft
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    
    // Remove Welcome Panel
    remove_action( 'welcome_panel', 'wp_welcome_panel' );

    }
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widget' );   