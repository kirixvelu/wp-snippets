<?php
// Exclude Search Category
function exclude_categories_from_search( $query ) {
    if ( ! is_admin() && $query->is_search && $query->is_main_query() ) {
        // Replace with your negative category IDs
        $query->set( 'cat', '-1,-2' );
    }
}
add_action( 'pre_get_posts', 'exclude_categories_from_search' );   