<?php
// Disable RSS Links / Kiri Vadivelu / 2026
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );   