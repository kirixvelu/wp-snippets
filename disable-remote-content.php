<?php
// Disable Remote Content / Kiri Vadivelu / 2026
// Disable the remote patterns coming from the Dotorg pattern directory.
add_filter( 'should_load_remote_block_patterns', '__return_false' );

// Remove and unregister patterns from core, Dotcom, and plugins.
add_filter( 'rest_dispatch_request', 'restrict_editor_patterns', 12, 3 );

function restrict_editor_patterns( $dispatch_result, $request, $route ) {
	if ( strpos( $route, '/wp/v2/block-patterns/patterns' ) === 0 ) {
		$patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();

		if ( ! empty( $patterns ) ) {
			// Remove theme support for all patterns from Dotcom, and plugins. 
			foreach ( $patterns as $pattern ) {
				unregister_block_pattern( $pattern['name'] );
			}

			// Remove theme support for core patterns from the Dotorg pattern directory. 
			remove_theme_support( 'core-block-patterns' );
		}
	}
	
	return $dispatch_result;
} 