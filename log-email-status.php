<?php
// Log Email Status
// Register the Admin Menu
add_action('admin_menu', 'register_all_menus');

function register_all_menus() {
  add_menu_page(
    'Email Log',
    'Email Log',
    'manage_options', // Access for Admin Only
    'smtp-log',
    'render_smtp_log_page',
    'dashicons-email-alt',
    99
);
}   

// Render the Email Log
function render_smtp_log_page() {
    $log_file = WP_CONTENT_DIR . '/email_log.txt';  

    if (!file_exists($log_file)) {
        echo '<div class="notice notice-warning"><p>No log file found yet.</p></div>';
        return;
    }

    // Read lines, reverse for newest-first display
    $lines = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $lines = array_reverse($lines);

    // Cap at 200 most recent entries
    $lines = array_slice($lines, 0, 200);
    ?>

    <!-- Make the log legible -->
    <div class="wrap" style="text-align:center">
        <h1>SMTP Email Log</h1>  
        <p class="description">Showing latest <?php echo count($lines) ?> event(s). Newest first, maximum 200 entries.</p>
    
        <style>
            .smtp-log-table { width: 100%; border-collapse: collapse; margin-top: 12px; }
            .smtp-log-table th, .smtp-log-table td {
                padding: 6px 10px; border-bottom: 1px solid #e0e0e0;
                font-family: monospace; font-size: 12px; text-align: left;
            }
            .smtp-log-table th { background: #f6f7f7; }
            .smtp-log-table tr:hover { background: #f0f6fc; }
            .log-error { color: #d63638; font-weight: bold; }
            .log-success { color: #00a32a; }
        </style>
        
        <table class="smtp-log-table">
            <thead>
                <tr><th>Timestamp</th><th>Message</th></tr>
            </thead>
            <tbody>
            <?php foreach ($lines as $line) :
                // Parse [timestamp] message
                if (preg_match('/^\[([\d\- :]+)\]\s(.*)$/', $line, $m)) {
                    $ts = $m[1];
                    $msg = $m[2];
                } else {
                    $ts = '';
                    $msg = $line;
                }
                $class = '';
                if (preg_match('/^[45]\d{2}/', $msg)) $class = 'log-error';
                elseif (strpos($msg, '250 2.0.0') !== false) $class = 'log-success';
                ?>
                <tr class="<?= $class ?>">
                    <td><?= esc_html($ts) ?></td>
                    <td><?= esc_html($msg) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Enable Gmail SMTP
add_action('phpmailer_init', 'enable_gmail_smtp');

function enable_gmail_smtp($phpmailer) {
    // Gmail SMTP Settings
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 587; // Use 465 for SSL
    $phpmailer->SMTPSecure = 'tls'; // Use 'ssl' for port 465
    $phpmailer->Username   = 'yourname@gmail.com'; // Your Gmail address
    $phpmailer->Password   = 'abcd efgh ijkl mnop'; // Your 16-digit App Password
    $phpmailer->From       = 'yourname@gmail.com';
    $phpmailer->FromName   = 'first last';

    
    // Enable Email Logging
    $phpmailer->SMTPDebug = 2; // Enable verbose debug output (2 = both client and server)
    $phpmailer->Debugoutput = 'enable_email_log';
}

// Complete Events (For testing only)
// function enable_email_log($message, $level) {
//     // Define log file path
//     $log_file = WP_CONTENT_DIR . '/email_log.txt';
    
//     // Format the log entry
//     $timestamp = current_time('mysql');
//     $log_entry = "[$timestamp] Level: $level - $message" . PHP_EOL;
    
//     // Append to log file
//     file_put_contents($log_file, $log_entry, FILE_APPEND);
// }   


// Summary Events (Recommended)
// function enable_email_log($message, $level) {
//     $log_file = WP_CONTENT_DIR . '/email_log.txt';

//     // Only log useful lines, skip handshake noise
//     $skip = [
//         'HELO', 'EHLO', '250-', '250 ',  // greeting / capability lists
//         'AUTH', '334',                    // auth exchange
//         'QUIT', '221',                    // session close
//     ];

//     foreach ($skip as $pattern) {
//         if (strpos($message, $pattern) !== false) {
//             return; // skip this line
//         }
//     }

//     $timestamp = current_time('mysql');
//     $log_entry = "[$timestamp] $message" . PHP_EOL;
//     file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
// }   

// Brief Events (Minimal)
function enable_email_log($message, $level) {
    // Only log errors and the final 250 delivery confirmation
    if (strpos($message, '250 2.0.0') === false
        && !preg_match('/^[45]\d{2}/', $message)
        && $level !== 4 // level 4 = critical error
    ) {
        return;
    }

    $log_file = WP_CONTENT_DIR . '/email_log.txt';
    $timestamp = current_time('mysql');   
    file_put_contents($log_file, "[$timestamp] $message" . PHP_EOL, FILE_APPEND | LOCK_EX);
}   
  

