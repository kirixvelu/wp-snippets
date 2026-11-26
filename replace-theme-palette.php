<?php
// Theme Replace Palette / Kiri Vadivelu / 2026
// For Twenty Twenty Five Default WordPress Theme, only affects the global theme layer — Site Editor user changes take precedence
function replace_theme_palette( $theme_json ) {
    $new_data = array(
        'version'  => 3,
        'settings' => array(
            'color' => array(
                'palette' => array(
                    array(
                        'slug'  => 'base',
                        'color' => '#FDDA0D',
                        'name'  => __( 'Base', 'textdomain' ),
                    ),
                    array(
                        'slug'  => 'contrast',
                        'color' => '#000000',
                        'name'  => __( 'Contrast', 'textdomain' ),
                    ),
                    array(
                        'slug'  => 'accent-1',
                        'color' => '#FFEE58',
                        'name'  => __( 'Accent 1', 'textdomain' ),
                    ),
                    array(
                        'slug'  => 'accent-2',
                        'color' => '#F6CFF4',
                        'name'  => __( 'Accent 2', 'textdomain' ),
                    ),
                    array(
                        'slug'  => 'accent-3',
                        'color' => '#503AA8',
                        'name'  => __( 'Accent 3', 'textdomain' ),
                    ),
                    array(
                        'slug'  => 'accent-4',
                        'color' => '#686868',
                        'name'  => __( 'Accent 4', 'textdomain' ),
                    ),
                    array(
                        'slug'  => 'accent-5',
                        'color' => '#FBFAF3',
                        'name'  => __( 'Accent 5', 'textdomain' ),
                    ),
                    array(
                        'slug'  => 'accent-6',
                        'color' => 'color-mix(in srgb, currentColor 20%, transparent)',
                        'name'  => __( 'Accent 6', 'textdomain' ),
                    ),
                ),
            ),
        ),
    );

    return $theme_json->update_with( $new_data );
}

add_action( 'after_setup_theme', function() {
    if ( function_exists( 'wp_theme_has_theme_json' ) && wp_theme_has_theme_json() ) {
        add_filter( 'wp_theme_json_data_theme', 'replace_theme_palette' );
    }
} );   