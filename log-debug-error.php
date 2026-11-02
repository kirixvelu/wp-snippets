<?php
// Log debug error
add_action( 'admin_menu', function () {
    add_menu_page(
        'Debug Log',
        'Debug Log',
        'manage_options',
        'view-debug-log',
        'render_debug_log_page',
        'dashicons-clipboard',
        99
    );
});

function render_debug_log_page() {
    $log_file = WP_CONTENT_DIR . '/debug.log';

    if ( ! file_exists( $log_file ) ) {
        echo '<div class="wrap"><p>No debug log found. Ensure <code>WP_DEBUG_LOG</code> is enabled.</p></div>';
        return;
    }

    // Get last 500 lines to avoid loading huge files
    $lines = file( $log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
    $lines = array_slice( $lines, -500 );

    echo '<div class="wrap">';
    echo '<h1>Debug Log (last ' . count( $lines ) . ' lines)</h1>';
    echo '<p><a href="' . admin_url( 'admin.php?page=view-debug-log&clear=1' ) . '" onclick="return confirm(\'Clear log file?\');">Clear Log</a></p>';
    echo '<pre style="background:#f6f7f7;padding:15px;max-height:700px;overflow:auto;">'
        . esc_html( implode( "\n", $lines ) )
        . '</pre>';
    echo '</div>';
}

// Handle clearing
if ( isset( $_GET['page'], $_GET['clear'] ) && $_GET['page'] === 'view-debug-log' && $_GET['clear'] === '1' ) {
    if ( current_user_can( 'manage_options' ) ) {
        $log_file = WP_CONTENT_DIR . '/debug.log';
        if ( file_exists( $log_file ) ) {
            file_put_contents( $log_file, '' );
        }
    }
    wp_safe_redirect( admin_url( 'admin.php?page=view-debug-log' ) );
    exit;
}   