<?php
// Debug Email Server / Kiri Vadivelu / 2026 
add_action( 'template_redirect', 'page_load_email' );
function page_load_email() {
  
$to = "wordpress@mysite.com"; // Replace with your email
$subject = 'wp_mail function test';
$message = 'This is a test of the wp_mail function: wp_mail is working';
$headers = '';


// Attempt to send the email
$sent_message = wp_mail( $to, $subject, $message, $headers );

// Display result in frontend
if ( $sent_message ) {
    echo 'The test message was sent. Check your email inbox.';
} else {
    echo 'The message was not sent!';
}
}   
// Also Log the error
add_action('wp_mail_failed', 'log_mailer_errors', 10, 1);
function log_mailer_errors( $wp_error ) {
    error_log( 'Mailer Error: ' . $wp_error->get_error_message() );
}   