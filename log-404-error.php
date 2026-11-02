<?php
// Log 404 Error
// Add admin menu
function add_404_log_menu() {
    add_menu_page(
        '404 Error Log',
        '404 Log',
        'manage_options',
        '404-log',
        'render_404_log_page',
        'dashicons-megaphone',
        80
    );
}
add_action( 'admin_menu', 'add_404_log_menu' );

// Render the page
function render_404_log_page() {
    global $wpdb;
    $table = $wpdb->prefix . '404_log';

    // Handle delete action
    if ( isset( $_GET['delete_id'] ) && check_admin_referer( 'delete_404_entry' ) ) {
        $wpdb->delete( $table, array( 'id' => intval( $_GET['delete_id'] ) ), array( '%d' ) );
        echo '<div class="notice notice-success"><p>Entry deleted.</p></div>';
    }

    // Handle clear all
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'clear' ) {
        check_admin_referer( 'clear_404_log' );
        $wpdb->query( "TRUNCATE TABLE $table" );
        echo '<div class="notice notice-success"><p>All 404 logs cleared.</p></div>';
    }

    // Pagination
    $per_page = 50;
    $page     = max( 1, intval( $_GET['paged'] ?? 1 ) );
    $offset   = ( $page - 1 ) * $per_page;

    $total   = $wpdb->get_var( "SELECT COUNT(*) FROM $table" );
    $entries = $wpdb->get_results( $wpdb->prepare(
        "SELECT * FROM $table ORDER BY created_at DESC LIMIT %d OFFSET %d",
        $per_page, $offset
    ) );
    $pages = ceil( $total / $per_page );
    ?>

    <div class="wrap">
        <h1>404 Error Log <span class="count">(<?php echo $total; ?>)</span></h1>

        <p>
            <a class="button" href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=404-log&action=clear' ), 'clear_404_log' ); ?>"
               onclick="return confirm('Delete ALL 404 log entries?');">Clear All</a>
        </p>

        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>URL</th>
                    <th>Referrer</th>
                    <th>IP</th>
                    <th>User Agent</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if ( empty( $entries ) ) : ?>
                <tr><td colspan="6">No 404 errors logged.</td></tr>
            <?php else : foreach ( $entries as $e ) : ?>
                <tr>
                    <td><?php echo $e->created_at; ?></td>
                    <td><a href="<?php echo esc_url( $e->url ); ?>" target="_blank"><?php echo esc_html( $e->url ); ?></a></td>
                    <td><?php echo $e->referrer ? '<a href="' . esc_url( $e->referrer ) . '" target="_blank">' . esc_html( $e->referrer ) . '</a>' : '—'; ?></td>
                    <td><?php echo esc_html( $e->ip ); ?></td>
                    <td><?php echo esc_html( substr( $e->user_agent, 0, 60 ) ); ?>…</td>
                    <td>
                        <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=404-log&delete_id=' . $e->id ), 'delete_404_entry' ); ?>"
                           onclick="return confirm('Delete this entry?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>

        <?php if ( $pages > 1 ) : ?>
            <div class="tablenav"><div class="tablenav-pages">
                <?php
                echo paginate_links( array(
                    'base'    => add_query_arg( 'paged', '%#%' ),
                    'format'  => '',
                    'current' => $page,
                    'total'   => $pages,
                ) );
                ?>
            </div></div>
        <?php endif; ?>
    </div>
    <?php
}    

// Log the 404 errors
function log_404_error() {
    if ( is_404() && ! is_admin() ) {
        global $wpdb;
        $table = $wpdb->prefix . '404_log';

        $wpdb->insert( $table, array(
            'url'        => esc_url_raw( home_url( $_SERVER['REQUEST_URI'] ) ),
            'referrer'   => esc_url_raw( $_SERVER['HTTP_REFERER'] ?? '' ),
            'ip'         => esc_sql( $_SERVER['REMOTE_ADDR'] ?? '' ),
            'user_agent' => esc_sql( substr( $_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500 ) ),
            'created_at' => current_time( 'mysql' ),
        ) );

        // Keep only the last 200 entries
        $wpdb->query( "DELETE FROM $table WHERE id NOT IN (
            SELECT id FROM (
                SELECT id FROM $table ORDER BY created_at DESC LIMIT 200
            ) AS keep_ids
        )" );
    }
}
add_action( 'template_redirect', 'log_404_error', 1 );   

// Run once (e.g., on plugin/theme activation) to create the table
function create_404_log_table() {
    global $wpdb;
    $table = $wpdb->prefix . '404_log';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        url VARCHAR(500) NOT NULL,
        referrer VARCHAR(500) DEFAULT '',
        ip VARCHAR(45) DEFAULT '',
        user_agent VARCHAR(500) DEFAULT '',
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY url (url),
        KEY created_at (created_at)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}
add_action( 'after_switch_theme', 'create_404_log_table' );
// Also run on init if table doesn't exist (safety net)
add_action( 'init', 'create_404_log_table' );   