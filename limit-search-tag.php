<?php
function limit_search_tag($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search) {
        $query->set('tag', 'green'); // Replace with tag name
    }
    return $query;
}
add_action('pre_get_posts', 'limit_search_tag');   