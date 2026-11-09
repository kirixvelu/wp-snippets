<?php
// Disable Auto Correct

// Disable URL Autocorrect Guessing
add_filter( 'redirect_canonical', '__return_false' );   

// Disable Smart Quotes
add_filter( 'run_wptexturize', '__return_false' );   