<?php
// Replace Default Role
function contributor_default_role( $default_role ) {
    return 'contributor'; // Replace your choice
}
add_filter( 'pre_option_default_role', 'contributor_default_role' );  