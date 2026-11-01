<?php
// Active Jetpack Module
add_filter( 'jetpack_active_modules', 'custom_jetpack_active_modules' );
function custom_jetpack_active_modules( $active ) {
    // Only these modules will be active
    $active = array(
        'stats',
        'monitor',
        'carousel',
        'seo-tools',
        'sitemaps',
        'contact-form',
        'canonical-urls',
        'verification-tools'
       
    );

    // List of other available modules for reference
    // To enable, move them into the $active array above
    /*
    $all_modules = array(
        'photon',
        'sharedaddy',
        'after-the-deadline',
        'comment-likes',
        'comments',
        'custom-content-types',
        'custom-css',
        'enhanced-distribution',
        'google-analytics',
        'gravatar-hovercards',
        'infinite-scroll',
        'json-api',
        'latex',
        'lazy-images',
        'likes',
        'manage',
        'markdown',
        'masterbar',
        'minileven',
        'module-extras',
        'module-headings',
        'module-info',
        'notes',
        'photon',
        'post-by-email',
        'protect',
        'publicize',
        'pwa',
        'related-posts',
        'search',
        'sharedaddy',
        'shortcodes',
        'shortlinks',
        'sso',
        'subscriptions',
        'theme-tools',
        'tiled-gallery',
        'vaultpress',
        'verification-tools',
        'videopress',
        'widget-visibility',
        'widgets',
        'wordads',
        'wpgroho.js',
    );
    */

    return $active;
}   