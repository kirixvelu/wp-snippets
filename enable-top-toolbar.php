<?php
// Enable Top Toolbar / Kiri Vadivelu / 2026
function enable_top_toolbar() {
    $script = "
        window.onload = function() {
            const isFixedToolbar = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fixedToolbar' );
            if ( !isFixedToolbar ) {
                wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fixedToolbar' );
            }
        };
    ";
    wp_add_inline_script( 'wp-blocks', $script );
}
add_action( 'enqueue_block_editor_assets', 'enable_top_toolbar' ); 