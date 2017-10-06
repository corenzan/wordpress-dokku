<?php
// Yea use themes.
define( 'WP_USE_THEMES', true );

// Update wp-content path.
// https://codex.wordpress.org/Editing_wp-config.php#Moving_wp-content_folder
define( 'WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content' );
define( 'WP_CONTENT_URL', '//' . $_SERVER['HTTP_HOST'] . '/wp-content' );

// Load from Wordpress installation.
require( dirname( __FILE__ ) . '/wordpress/wp-blog-header.php' );
