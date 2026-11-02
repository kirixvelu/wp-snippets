<?php
// Scroll Progress Bar
add_action('wp_body_open', function() {
    echo '<div id="wpcode-progress-bar"></div>';
});

add_action('wp_head', function() {
    echo '<style>
        #wpcode-progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background-color: var(--wp--preset--color--primary, #007bff); /* Change the color as needed */
            z-index: 99;
        }
		@media( min-width: 769px ) {
		.admin-bar #wpcode-progress-bar {
			top: 32px;
		}
		}
    </style>';
});

add_action('wp_footer', function() {
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener("scroll", function() {
                var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                var scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
                var clientHeight = document.documentElement.clientHeight || document.body.clientHeight;
                var scrolled = (scrollTop / (scrollHeight - clientHeight)) * 100;

                document.getElementById("wpcode-progress-bar").style.width = scrolled + "%";
            });
        });
    </script>';
});
