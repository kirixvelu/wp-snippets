<?php
// Minimal login form
// Hide Login Errors 
add_filter(
	'login_errors',
	function ( $error ) {
		// Customize the Message
		return 'Something is wrong!';
	}
);

// Remove Login Links
add_action( 'login_head', 'remove_login_links' );
function remove_login_links() {
    add_filter( 'login_site_html_link', '__return_empty_string' ); 
    // Back to Link
    add_filter( 'register', '__return_empty_string' ); 
    // Register
    add_filter( 'lost_password_html_link', '__return_empty_string' ); 
    // Lost Password
}   

// Hide WP Logo, Remove Links and Style Form
function remove_wp_login_logo() {
    echo '<style>
        .login h1 a, .forgetmenot { 
            display: none !important; 
        }
        .login form {
        border: 0 !important;
        border-radius: 20px;
        }
    </style>';
    
add_filter('login_headerurl', '__return_false');
add_filter('login_headertext', function() { return ''; });
}
add_action('login_enqueue_scripts', 'remove_wp_login_logo');  

// Disable Login Screen Language Switcher
add_filter( 'login_display_language_dropdown', '__return_false' ); 