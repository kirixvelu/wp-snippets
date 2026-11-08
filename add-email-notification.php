<?php
// Email User Registration / Kiri Vadivelu / 2026
add_filter( 'wp_new_user_notification_email_admin', 'custom_admin_notification', 10, 3 );
function custom_admin_notification( $wp_new_user_notification_email_admin, $user, $blogname ) {
    $wp_new_user_notification_email_admin['to'] = 'your@email.com';
    return $wp_new_user_notification_email_admin;
}  