<?php
// Manage Core Block / Kiri Vadivelu / 2026
add_filter( 'allowed_block_types_all', 'manage_core_blocks_wp72', 10, 2 );

function manage_core_blocks_wp72( $allowed_blocks, $context ) {
    // Allow all blocks in the Site Editor or for templates
    if ( isset( $context->post ) && $context->post ) {
        $post_type = $context->post->post_type;
        if ( in_array( $post_type, array( 'wp_template', 'wp_template_part' ), true ) ) {
            return true;
        }
    }

    return array(

        // ─── TEXT BLOCKS ───────────────────────────────────────────────
        'core/paragraph',
        'core/heading',
        'core/list',
        'core/list-item',
        'core/quote',
        'core/pullquote',
        //'core/code',
        'core/details',
        //'core/math',
        //'core/preformatted',
        'core/table',
        //'core/poetry',
        //'core/freeform',
        //'core/footnotes',
        //'core/missing',

        // ─── MEDIA BLOCKS ──────────────────────────────────────────────
        'core/image',
        //////'core/gallery',
        //////'core/audio',
        'core/cover',
        'core/file',
        'core/media-text',
        //////'core/playlist',
        //////'core/video',
        'core/icon',

        // ─── DESIGN BLOCKS ─────────────────────────────────────────────
        'core/accordion',
        'core/buttons',
        'core/button',
        'core/columns',
        'core/group',
        'core/row',
        'core/stack',
        'core/grid',
        'core/more',
        'core/nextpage',
        'core/separator',
        'core/spacer',
        'core/tabs',
        'core/table-of-contents',   // NEW in 7.2 — server-rendered, dynamic
        'core/description-list',     // NEW in 7.2

        // ─── WIDGET BLOCKS ─────────────────────────────────────────────
        'core/archives',
        ////'core/calendar',
        'core/term-list',
        'core/categories',
        ////'core/html',
        ////'core/latest-comments',
        'core/latest-posts',
        'core/page-list',
        ////'core/rss',
        ////'core/search',
        'core/shortcode',
        'core/social-links',
        'core/tag-cloud',

        // ─── THEME / DYNAMIC BLOCKS ────────────────────────────────────
        'core/term-description',
        'core/term-name',
        'core/term-query',
        'core/archive-title',
        'core/search-results-title',
        'core/post-types-label',
        'core/post-author-biography',
        'core/template-part',
        'core/query-title',
        'core/post-navigation-link',
        'core/breadcrumbs',
        //'core/comments-title',
        'core/loginout',
        'core/navigation',
        'core/pattern',
        'core/post-author-name',
        //'core/post-comments-count',
        //'core/post-comments-form',
        'core/post-date',
        'core/post-featured-image',
        'core/post-navigation',
        'core/post-terms',
        'core/post-title',
        'core/post-content',
        'core/post-excerpt',
        'core/query',
        'core/query-pagination',
        'core/query-pagination-numbers',
        'core/query-pagination-next',
        'core/query-pagination-previous',
        'core/site-tagline',
        'core/site-title',
        'core/site-logo',
        'core/home-link',
        'core/navigation-link',
        'core/navigation-submenu',
        //'core/comments',
        //'core/comment-template',//
        //'core/comment-author-name',
        //'core/comment-author-avatar',
        //'core/comment-content',
        //'core/comment-date',
        //'core/comment-edit-link',
        //'core/comment-reply-link',
        'core/post-template',
        'core/post-template-block',
        'core/post-viewport',

        // ─── EMBED BLOCKS ──────────────────────────────────────────────
        //'core/embed' // Disable embed and its variations
       
    );
}   