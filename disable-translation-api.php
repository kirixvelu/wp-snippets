<?php
// Disable Translation Service
add_filter( 'pre_load_textdomain', '__return_false', -5 );
add_filter( 'pre_load_script_translations', '__return_false', -5 );

// Disable Translation Updates
add_filter( 'auto_update_translation', '__return_false' );
add_filter( 'async_update_translation', '__return_false' );   