<?php
// Force en_US site-wide (front-end + admin)
add_filter( 'locale', function( $locale ) {
    return 'en_US';
} ); 

// Force the <html> lang attribute to en-US
// Disable Browser Auto-Translation (add translate="no")
add_filter( 'language_attributes', function() {
    return 'lang="en-US" translate="no"';
} );   

// Disable all auto translation updates
add_filter( 'auto_update_translation', '__return_false' );
add_filter( 'async_update_translation', '__return_false' );   

  