<?php
/*
Plugin Name: WordPress Header Shortlink Disabler
Plugin URI: 
Description: Remove shortlink hook added by wp_head() in in WordPress header.
Version: 1.0
Author: 
Author URI: 
*/

remove_action( Ôwp_headÕ, Ôwp_shortlink_wp_headÕ, 10, 0 ); // Remove WordPress shortlink on wp_head hook

?>