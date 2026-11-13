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

// Link Homepage
add_filter( 'login_headerurl', function() { return home_url(); } );
add_filter( 'login_headertext', function() { return get_bloginfo( 'name' ); } ); 

// Add Site Logo
function site_login_logo() { ?>
    <style type="text/css">
        .login .wp-login-logo a,
        #login h1 a {
            background-image: url('') !important;
            background-repeat: no-repeat;
            background-position: center;
            border-radius: 50%;
            overflow: hidden;
            display: block;
        }
    </style>
<?php }
add_action( 'login_head', 'site_login_logo' );  

// Disable Language Switcher
add_filter( 'login_display_language_dropdown', '__return_false' ); 