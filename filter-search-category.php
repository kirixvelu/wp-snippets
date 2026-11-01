<?php
// Filter search category
// Extends default search to filter based on predetermined category. Require advanced search form and additional setup.
function advanced_search_filter( $query ) {
    // Only modify the main query on the front-end search results
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        
        // Check if category_name is set, is an array and not empty
        if ( isset( $_GET['category_name'] ) && is_array( $_GET['category_name'] ) && (! empty($_GET['category_name'])) ) {
            
            // Get the array of category slugs
            $categories = $_GET['category_name'];
            
            // Implode the array into a comma-separated string
            // WordPress accepts comma-separated category slugs
            $category_string = implode( ',', $categories );
            
            // Set the category_name query variable
            $query->set( 'category_name', $category_string );
        }
    }
    return $query;
}
add_action( 'pre_get_posts', 'advanced_search_filter' );