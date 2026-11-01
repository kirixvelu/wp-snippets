<?php
// Add Security Headers
function add_security_headers() {
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    // header("Content-Security-Policy: default-src 'self'; img-src 'self' data: https:; script-src 'self' 			'unsafe-inline' https:; style-src 'self' 'unsafe-inline' https:; frame-ancestors 'self'");
	header("X-Frame-Options: SAMEORIGIN");
    header("X-Content-Type-Options: nosniff");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Permissions-Policy: camera=(), microphone=(), geolocation=()");
}
add_action('send_headers', 'add_security_headers');   