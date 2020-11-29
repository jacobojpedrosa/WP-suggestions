<?php 
	if (!defined('WP_UNINSTALL_PLUGIN')) {
	    global $wpdb;
	    $wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . "suggestions" );
	}



?>