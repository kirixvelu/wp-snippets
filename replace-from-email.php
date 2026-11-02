<?php
// Replace From Email
add_filter( 'wp_mail_from', function ( $old ) {
    return 'dev@wpsite.local'; // Replace with your email
} );

add_filter( 'wp_mail_from_name', function ( $old ) {
    return 'Super Dev'; // Replace with your name
} );   