<?php
// Remove All Emoji / Kiri Vadivelu / 2026
add_action( 'init', 'remove_emoji' );
function remove_emoji() {
    // Frontend & admin
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // oEmbed iframes
    remove_action( 'embed_head', 'print_emoji_detection_script' );
    remove_action( 'enqueue_embed_scripts', 'wp_enqueue_emoji_styles' );

    // Feeds & email
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    // Block editor
    add_filter( 'emoji_svg_url', '__return_false' );
} 