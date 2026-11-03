<?php
// Disable Translation Service
add_filter( 'pre_load_textdomain', '__return_false', -5 );
add_filter( 'pre_load_script_translations', '__return_false', -5 );