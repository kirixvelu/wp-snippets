<?php
// Require JS field
add_action('login_enqueue_scripts', 'field_without_script');
function field_without_script() {
    echo '<noscript><style>
        #user_pass,
        label[for="user_pass"] {
            display: none !important;
        }
    </style></noscript>';
}   