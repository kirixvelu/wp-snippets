<?php
// Replace wp_mail with native PHP mail()

add_filter('pre_wp_mail', 'use_native_mail', 10, 2);

function use_native_mail($null, $atts) {
    $to = $atts['to'];
    $subject = $atts['subject'];
    $message = $atts['message'];
    $headers = isset($atts['headers']) ? $atts['headers'] : '';
    $attachments = isset($atts['attachments']) ? $atts['attachments'] : array();
    
    // Convert to array to string if needed
    if (is_array($to)) {
        $to = implode(', ', $to);
    }
    
    // Convert headers array to string if needed
    if (is_array($headers)) {
        $headers = implode("\r\n", $headers);
    }
    
    // Use native mail()
    mail($to, $subject, $message, $headers, $attachments);
    
    // Return true to prevent wp_mail from running
    return true;
}