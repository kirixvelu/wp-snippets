<?php
// Limit search category
function limit_search_category($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search) {
        $query->set('cat', '3'); // Replace with category ID(s)
    }
    return $query;
}
add_filter('pre_get_posts', 'limit_search_category');   