<?php
// Disable Admin Bar
add_filter('show_admin_bar', 'disable_admin_bar');

function disable_admin_bar($show) {
    return current_user_can('administrator') ? true : false;
}   