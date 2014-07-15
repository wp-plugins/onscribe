<?php
/**
 * Onscribe: Asset files
 *
 * @author Makis Tracend
 * @copyright K&D Interactive Inc., All Rights Reserved
 * This code is released under the GPL license version 3 or later, available here
 * http://www.gnu.org/licenses/gpl.txt
 */


function onscribe_assets() {
	wp_register_style( 'onscribe_wp_admin_css', plugin_dir_url( __FILE__ ) . 'assets/onscribe.css' );
	wp_enqueue_style( 'onscribe_wp_admin_css' );
	//
	wp_enqueue_script( 'onscribe_wp_admin_js', plugin_dir_url( __FILE__ ) . 'assets/onscribe.js', array( 'jquery' ) );
}
