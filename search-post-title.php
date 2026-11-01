<?php
// Limit the search to post title only
add_filter( 'post_search_columns', function( $columns ) {
return [ 'post_title' ];
} );