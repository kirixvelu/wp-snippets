<?php
// Replace Editor Palette / Kiri Vadivelu / 2026
// Override Site Editor color palette but retain user preference
function my_theme_override_editor_colors( $theme_json ) {
    $new_data = array(
        'version'  => 3,
        'settings' => array(
            'color' => array(
                'custom'         => false,  // Remove hex color picker
                'defaultPalette' => false,  // Remove WP core colors
                'palette'        => array(
                    array( 'slug' => 'base',     'color' => '#FFFFFF', 'name' => 'Base' ),
                    array( 'slug' => 'contrast', 'color' => '#000000', 'name' => 'Contrast' ),
                    array( 'slug' => 'accent-1', 'color' => '#FFEE58', 'name' => 'Accent 1' ),
                    array( 'slug' => 'accent-2', 'color' => '#F6CFF4', 'name' => 'Accent 2' ),
                    array( 'slug' => 'accent-3', 'color' => '#503AA8', 'name' => 'Accent 3' ),
                    array( 'slug' => 'accent-4', 'color' => '#686868', 'name' => 'Accent 4' ),
                    array( 'slug' => 'accent-5', 'color' => '#FBFAF3', 'name' => 'Accent 5' ),
                    array( 'slug' => 'accent-6', 'color' => 'color-mix(in srgb, currentColor 20%, transparent)', 'name' => 'Accent 6' ),
                ),
            ),
        ),
    );

    return $theme_json->update_with( $new_data );
}

add_action( 'after_setup_theme', function () {
    if ( wp_theme_has_theme_json() ) {
        // Highest priority layer — overrides Site Editor saved styles
        add_filter( 'wp_theme_json_data_user', 'my_theme_override_editor_colors' );
    }
} );   