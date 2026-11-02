<?php
// Block Outbound API
add_filter( 'pre_http_request', 'dwp_pre_http_request_block', 10, 3 );
function dwp_pre_http_request_block( $preempt, $args, $url ) {

        $block_list = [
           
            //Blocks WordPress from getting the information about themes
            '://api.wordpress.org/themes/info/',

            //Blocks various requests to WordPress API
            '://api.wordpress.org/core/version-check/',
            '://api.wordpress.org/core/browse-happy/',
            '://api.wordpress.org/core/serve-happy/',
            '://api.wordpress.org/plugins/info/',
            '://api.wordpress.org/plugins/update-check/',
          
        ];

        foreach($block_list as $b) {
            if ( strpos( $url, $b ) !== false ) {
                //Returning the status code "200" ensures there will be no errors generated
                //from WordPress or red/orange notices in the Query Monitor plugin
                return ['response' => ['code' => 200, 'message' => 'OK']];
            }
        }
        
        return $preempt;
}