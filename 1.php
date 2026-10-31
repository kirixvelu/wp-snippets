<?php
// Limit the search to post title only, exclude content
add_filter( 'post_search_columns', function( $columns ) {
return [ 'post_title' ];
} );