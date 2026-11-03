<?php
// Block Username Scan
add_action('template_redirect', function () {
    if (!is_user_logged_in() && isset($_GET['author'])) {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }
}, 1);

// Stop ?author=N scans from revealing usernames on the front end.
// Priority 1 runs before core's redirect_canonical, which would
// otherwise redirect to /author/username/ and leak the name.