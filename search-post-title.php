<?php
// Limit the search to post title / V7
add_filter( 'post_search_columns', function( $columns ) {
return [ 'post_title' ];
} );