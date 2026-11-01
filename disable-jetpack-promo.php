<?php
// Disable Jetpack Promotion
add_filter( 'jetpack_ai_enabled', '__return_false' );   
add_filter( 'jetpack_just_in_time_msgs', '__return_false' );
add_filter( 'jetpack_just_in_time_msgs_allowed', '__return_false' );
add_filter( 'jetpack_just_in_time_msgs_allowed_list', '__return_false' );
add_filter( 'jetpack_just_in_time_highlight_reel', '__return_false' );
add_filter( 'jetpack_show_promotions', '__return_false' );
add_filter( 'jetpack_blaze_enabled', '__return_false' );   