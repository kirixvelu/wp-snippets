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