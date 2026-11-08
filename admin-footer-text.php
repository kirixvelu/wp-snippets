<?php
// Admin Footer Text / Kiri Vadivelu / 2026
add_filter(
	'admin_footer_text',
	function ( $footer_text ) {
		// Customize the admin footer text
		$footer_text = 'Designed with <a href="https://www.wordpress.org" target="_blank" rel="noopener">WordPress</a> | Project by <a href="https://digitaldesigners.ca" target="_blank" rel="noopener">Digital Designers CA</a>';
		
		return $footer_text;
	}
);