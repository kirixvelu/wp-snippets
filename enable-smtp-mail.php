<?php
// Enable SMTP Mail
add_action('phpmailer_init', 'send_gmail_smtp');
function send_gmail_smtp($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 587; // Use 465 for SSL, 587 for TLS
    $phpmailer->SMTPSecure = 'tls'; // 'ssl' for port 465
    $phpmailer->Username   = 'your-email@gmail.com';
    $phpmailer->Password   = 'your-app-password'; // App password only
    $phpmailer->From       = 'your-email@gmail.com';
    $phpmailer->FromName   = 'Your Name';
}     