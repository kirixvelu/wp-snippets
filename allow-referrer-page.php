<?php
// Allow Referrer Page / Kiri Vadivelu / 2026
add_action('template_redirect', function() {
    // ID of the page to protect eg. Thank You page
    if (!is_page(123)) {
        return;
    }

    // URL of the allowed referring page
    if (wp_get_referer() === 'https://yoursite.com/form-page/') {
        return;
    }

    // Redirect unauthorized direct access
    wp_redirect(get_home_url());
    exit;
});   