<?php
/*
Plugin Name: Onscribe
Version: 0.1.1
Plugin URI: http://www.github.com/onscribe/wordpress/
Description: Simple integration for Onscribe. Adds subscription buttons to any webpage.
Author: Onscribe
Author URI: http://onscri.be/
*/
/**
 * @author Makis Tracend
 * @copyright K&D Interactive Inc., All Rights Reserved
 * This code is released under the GPL license version 3 or later, available here
 * http://www.gnu.org/licenses/gpl.txt
 */

// modules
include_once( dirname(__FILE__) ."/settings.php");
include_once( dirname(__FILE__) ."/shortcode.php");
include_once( dirname(__FILE__) ."/assets.php");
include_once( dirname(__FILE__) ."/meta_box.php");

// Actions
if (function_exists( 'add_action' ) ) {
	// hooks
	add_action( 'admin_enqueue_scripts', 'onscribe_assets' );
	add_action( 'add_meta_boxes', 'onscribe_add_meta_box' );

	// interface
	add_shortcode( 'onscribe', 'onscribe_shortcode' );

}


?>
