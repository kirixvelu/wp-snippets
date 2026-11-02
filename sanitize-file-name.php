<?php
// Sanitize file name
add_filter( 'sanitize_file_name', 'mb_strtolower' );