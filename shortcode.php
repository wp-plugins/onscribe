<?php
/**
 * Onscribe: Shortcode
 *
 * @author Makis Tracend
 * @copyright K&D Interactive Inc., All Rights Reserved
 * This code is released under the GPL license version 3 or later, available here
 * http://www.gnu.org/licenses/gpl.txt
 */


// Shortcode
// Example: [onscribe]
function onscribe_shortcode( $atts ) {
	$template = "embed.php";
	extract( shortcode_atts( array(
		"product" => "",
		"style" => "",
		"prompt" => ""
	), $atts ) );
	// output
	ob_start();
	require( plugin_dir_path( __FILE__ ) ."/". $template);
	return ob_get_clean();
}