<?php
// Disable Comment Module
// Remove comment support from all post types
function disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'disable_comments_post_types_support');

// Close comments on the frontend
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments from displaying
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments from admin menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});   

// Remove admin discussion link
add_action('admin_menu', function () {
    remove_submenu_page('options-general.php', 'options-discussion.php');
});   

// Disable URL direct access
add_action('admin_init', function () {
    global $pagenow;

    if ($pagenow === 'options-discussion.php') {
        wp_safe_redirect(admin_url('options-general.php'));
        exit;
    }
});       