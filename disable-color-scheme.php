<?php
// Disable Color Scheme
add_action( 'admin_init', function() {
	remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
});