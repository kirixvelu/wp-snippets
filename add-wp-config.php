<?php
// Add to WP Config file

// Disable Automatic Updates effectively
define( 'AUTOMATIC_UPDATER_DISABLED', true );   

// Stop silent database table growth
define( 'WP_POST_REVISIONS', 5 );

// Disable all ai features
define( 'WP_AI_SUPPORT', false ); 

// Reduce Garbage Retention
define( 'EMPTY_TRASH_DAYS', 7 );   

// Force SSL
define('FORCE_SSL_ADMIN', true);

/* Force SSL & Override SSL */
define('FORCE_SSL_ADMIN', true);
if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)
   $_SERVER['HTTPS']='on';
   