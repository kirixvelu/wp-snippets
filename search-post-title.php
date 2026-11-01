<?php
// Limit all search to post title
add_filter( 'post_search_columns', function( $columns ) {
return [ 'post_title' ];
} );
