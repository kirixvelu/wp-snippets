<?php
// Disable brute force access
add_action( 'xmlrpc_call', function ( $method ) {
    if ( $method === 'system.multicall' ) {
        wp_die( 'Method not allowed.', 'XML-RPC Error', [ 'response' => 403 ] );
    }
} );   