<?php
// Log HTTP Request
// File based log
define( 'HTTP_LOG_FILE', WP_CONTENT_DIR . '/http-requests.log' );

function my_log_http_request( $response, $request, $url ) {
    $log_entry = [
        'time' => current_time( 'mysql' ),   
        'method'  => $request['method'],
        'url'     => $url,
        'body'    => $request['body'] ?? '',
    ];

    if ( $response instanceof WP_Error ) {
        $log_entry['status'] = 'ERROR';
        $log_entry['detail'] = $response->get_error_message();
    } else {
        $log_entry['status'] = wp_remote_retrieve_response_code( $response );
        $log_entry['detail'] = wp_remote_retrieve_response_message( $response );
    }

    // Append as a single JSON line
    file_put_contents(
        HTTP_LOG_FILE,
        wp_json_encode( $log_entry ) . "\n",
        FILE_APPEND | LOCK_EX
    );

     // Trim to last 200 entries
    $lines = file( HTTP_LOG_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
    if ( count( $lines ) > 200 ) {
        $lines = array_slice( $lines, -200 );
        file_put_contents( HTTP_LOG_FILE, implode( "\n", $lines ) . "\n", LOCK_EX );
    }

    return $response;
}

add_filter( 'http_response', 'my_log_http_request', 10, 3 );


// Create admin menu page
function my_http_logs_menu() {
    add_menu_page(
        'HTTP Logs',       // Page title
        'Server Log',       // Menu label
        'manage_options',  // Capability
        'http-logs',       // Slug
        'my_http_logs_page'
    );
}
add_action( 'admin_menu', 'my_http_logs_menu' );


// Render the log viewer
function my_http_logs_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Insufficient permissions.' );
    }

    $lines = [];
    if ( file_exists( HTTP_LOG_FILE ) ) {
        $lines = file( HTTP_LOG_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
        $lines = array_reverse( $lines ); // newest first
    }
    ?>
    <div class="wrap">
        <h1 style="text-align: center;">HTTP Requests Log</h1>
        <p><em>File: <code><?php echo esc_html( HTTP_LOG_FILE ); ?></code></em></p>

        <?php if ( empty( $lines ) ) : ?>
            <p>No HTTP requests logged yet.</p>
        <?php else : ?>
        <table class="wp-list-table widefat striped">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Method</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ( $lines as $line ) :
                $entry = json_decode( $line, true );
                if ( ! $entry ) continue;
                ?>
                <tr>
                    <td><?php echo esc_html( $entry['time'] ); ?></td>
                    <td><?php echo esc_html( $entry['method'] ); ?></td>
                    <td><code><?php echo esc_html( $entry['url'] ); ?></code></td>
                    <td>
                        <?php
                        $status = $entry['status'];
                        $color  = ( $status >= 200 && $status < 300 ) ? '#00a32a' : '#d63638';
                        echo '<span style="color:' . $color . ';font-weight:bold">' . esc_html( $status ) . '</span>';
                        ?>
                    </td>
                    <td><?php echo esc_html( $entry['detail'] ); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
    <?php
}   