<?php
// Limit all search to post only
add_action( 'pre_get_posts', function( $query ) {
    $query->set( 'post_type', array( 'post' ) );
} );   