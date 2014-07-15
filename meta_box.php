<?php
/**
 * Onscribe: Meta box
 *
 * @author Makis Tracend
 * @copyright K&D Interactive Inc., All Rights Reserved
 * This code is released under the GPL license version 3 or later, available here
 * http://www.gnu.org/licenses/gpl.txt
 */

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function onscribe_add_meta_box() {

	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'onscribe_products',
			__( 'Onscribe', 'onscribe' ),
			'onscribe_meta_box_callback',
			$screen
		);
	}
}

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function onscribe_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	//wp_nonce_field( 'onscribe_meta_box', 'onscribe_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	//$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

	// get onscribe settings
	$onscribe = get_option('onscribe', array() );
	// first-time fallbacks
	if( empty($onscribe) ) $onscribe = array();
	$products = array_key_exists("products", $onscribe) ? $onscribe["products"]: array();

	// create dropdown with products
	echo "<p>Generate onscribe buttons anywhere in your post:</p>";
	echo '<label for="onscribe_products">';
	_e( 'Select a product', 'onscribe' );
	echo '</label> ';
	echo '<select id="onscribe_products" name="onscribe_products">';
	foreach( $products as $product ){
		// supoprt objects/arrays
		$key = ( is_array($product) ) ? $product['key'] : $product->key;
		$title = ( is_array($product) ) ? $product['title'] : $product->title;
		echo '<option value="'. $key .'">'. $title .'</option> ';
		// value="' . esc_attr( $value ) . '" size="25"
	}
	echo '</select>';

	// other shortcode options
	echo '<p>Additional options to customize the display:</p>';

	echo '<h3>';
	echo '<input type="radio" id="onscribe_option_format_icons" name="onscribe_option_format" value="icons"> ';
	echo '<label for="onscribe_option_format_icons">Only icons</label>';
	echo '</h3>';

	echo '<p>';
	echo '<input type="radio" id="onscribe_option_icons_small" name="onscribe_option_icons" value="small"> ';
	echo '<label for="onscribe_option_icons_small">small</label> ';
	echo '<input type="radio" id="onscribe_option_icons_regular" name="onscribe_option_icons" value="regular"> ';
	echo '<label for="onscribe_option_icons_regular">regular</label> ';
	echo '</p>';

	echo '<h3>';
	echo '<input type="radio" id="onscribe_option_format_text" name="onscribe_option_format" value="text"> ';
	echo '<label for="onscribe_option_format_text">With text</label>';
	echo '</h3>';

	echo '<p>';
	echo '<input type="radio" id="onscribe_option_text_small" name="onscribe_option_text" value="short"> ';
	echo '<label for="onscribe_option_text_small">short form</label> ';
	echo '<input type="radio" id="onscribe_option_text_long" name="onscribe_option_text" value="long"> ';
	echo '<label for="onscribe_option_text_long">long form</label> ';
	echo '<input type="text" id="onscribe_option_text_custom" name="onscribe_option_text_custom" placeholder="custom prompt...">';
	echo '</p>';

	echo '<input type="submit" id="onscribe-shortcode-gen" class="button" value="Insert">';

}
