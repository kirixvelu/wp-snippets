<?php
// Site Editor Palette / Kiri Vadivelu / 2026
// Require theme switch to update palette
function site_editor_palette() {
    $theme = wp_get_theme()->get_stylesheet();

    // Find the existing global styles post for this theme
    $post_id = WP_Theme_JSON_Resolver::get_user_global_styles_post_id();

    if ( ! $post_id ) {
        // Create one if it doesn't exist
        $post_id = wp_insert_post( array(
            'post_type'    => 'wp_global_styles',
            'post_title'   => 'Custom Styles',
            'post_name'    => 'wp-global-styles-' . $theme,
            'post_content' => '',
            'post_status'  => 'publish',
        ) );

        // Assign the theme taxonomy term (required for the post to be recognized)
        $term = term_exists( $theme, 'wp_theme' );
        if ( ! is_array( $term ) ) {
            $term = wp_insert_term( $theme, 'wp_theme' );
        }
        wp_set_post_terms( $post_id, array( $term['term_id'] ), 'wp_theme' );
    }

    // Read existing content (this is the JSON blob, NOT post meta)
    $existing = get_post( $post_id );
    $config   = $existing->post_content ? json_decode( $existing->post_content, true ) : array();

    // Ensure required keys
    if ( ! isset( $config['version'] ) ) {
        $config['version'] = 3;
    }
    if ( ! isset( $config['isGlobalStylesUserThemeJSON'] ) ) {
        $config['isGlobalStylesUserThemeJSON'] = true;
    }

    // Set the palette
    $config['settings']['color']['palette'] = array(
        array( 'slug' => 'base',     'color' => '#FFFFFF', 'name' => 'Base' ),
        array( 'slug' => 'contrast', 'color' => '#000000', 'name' => 'Contrast' ),
        array( 'slug' => 'accent-1', 'color' => '#FFEE58', 'name' => 'Accent 1' ),
        array( 'slug' => 'accent-2', 'color' => '#F6CFF4', 'name' => 'Accent 2' ),
        array( 'slug' => 'accent-3', 'color' => '#503AA8', 'name' => 'Accent 3' ),
        array( 'slug' => 'accent-4', 'color' => '#686868', 'name' => 'Accent 4' ),
        array( 'slug' => 'accent-5', 'color' => '#FBFAF3', 'name' => 'Accent 5' ),
        array( 'slug' => 'accent-6', 'color' => 'color-mix(in srgb, currentColor 20%, transparent)', 'name' => 'Accent 6' ),
    );

    // Write back to post_content
    wp_update_post( array(
        'ID'           => $post_id,
        'post_content' => wp_json_encode( $config ),
    ) );
}

// Run once (e.g. on theme activation or manually)
add_action( 'after_switch_theme', 'site_editor_palette' );   