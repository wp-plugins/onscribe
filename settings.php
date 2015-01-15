<?php
/**
 * Onscribe: Settings
 *
 * @author Makis Tracend
 * @copyright K&D Interactive Inc., All Rights Reserved
 * This code is released under the GPL license version 3 or later, available here
 * http://www.gnu.org/licenses/gpl.txt
 */

class OnscribeSettings
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page()
	{
		// This page will be under "Settings"
		add_options_page(
			'Settings Admin',
			'Onscribe',
			'manage_options',
			'onscribe-admin',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option( 'onscribe' );
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>Onscribe Settings</h2>
			<form method="post" action="options.php">
			<?php
				// This prints out all hidden setting fields
				settings_fields( 'onscribe_group' );
				do_settings_sections( 'onscribe-admin' );
				submit_button();
			?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init()
	{
		register_setting(
			'onscribe_group', // Option group
			'onscribe', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'onscribe_products', // ID
			'Available Products', // Title
			array( $this, 'onscribe_products_list' ), // Callback
			'onscribe-admin' // Page
		);


		add_settings_section(
			'onscribe_add', // ID
			'New Product', // Title
			array( $this, 'onscribe_add_info' ), // Callback
			'onscribe-admin' // Page
		);

		add_settings_field(
			'products', // ID
			null, // Title
			array( $this, 'onscribe_fields_products' ), // Callback
			'onscribe-admin', // Page
			'onscribe_add' // Section
		);

		add_settings_field(
			'key', // ID
			'API key', // Title
			array( $this, 'onscribe_fields_key' ), // Callback
			'onscribe-admin', // Page
			'onscribe_add' // Section
		);

		add_settings_field(
			'secret',
			'API secret',
			array( $this, 'onscribe_fields_secret' ),
			'onscribe-admin',
			'onscribe_add'
		);

		add_settings_field(
			'title', // ID
			null, // Title
			array( $this, 'onscribe_fields_title' ), // Callback
			'onscribe-admin', // Page
			'onscribe_add' // Section
		);

	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input )
	{

		$input["products"] = ( is_string( $input["products"] ) ) ? json_decode( $input["products"] ) : $input["products"];
		if( empty( $input["products"] ) ) $input["products"] = array();

		$product = array();
		if( isset( $input['key'] ) && !empty($input['key']) )
			$product['key'] = sanitize_text_field( $input['key'] );

		if( isset( $input['secret'] ) && !empty($input['secret']) )
			$product['secret'] = sanitize_text_field( $input['secret'] );

		if( isset( $input['title'] ) && !empty($input['title']) )
			$product['title'] = sanitize_text_field( $input['title'] );

		// reset
		$input["key"] = "";
		$input["secret"] = "";
		$input["title"] = "";

		// FIX: stop if empty creds submitted
		if( !empty($product) ) array_push( $input["products"], $product );

		return $input;
	}

	/**
	 * Print the Section text
	 */
	public function onscribe_products_list()
	{
		if( ( is_array($this->options) && !array_key_exists("products", $this->options) ) || empty($this->options["products"]) ){
			echo "<p>No products registered yet. Please add them using the fields below</p>";
			return;
		}
		echo "<p>Here is a list of the products you previously added:</p>";
		echo '<table class="products-list">';
		foreach( $this->options["products"] as $product ){
			$key = ( is_array($product) ) ? $product['key'] : $product->key;
			$secret = ( is_array($product) ) ? $product['secret'] : $product->secret;
			$title = ( is_array($product) ) ? $product['title'] : $product->title;
			echo '<tr>';
			echo '<td class="title">'. $title .'</td>';
			echo '<td class="key">'. $key .'</td><td class="secret">'. $secret .'</td>';
			// delete button
			echo '<td class="delete"><a href="#" data-key="'. $key .'">[ X ]</a></td>';
			echo '</tr>';
		}
		echo "</table>";
	}

	/**
	 * Print the Section text
	 */
	public function onscribe_add_info()
	{
		print 'If you want to add a new product, include its credentials below:';
	}


	/**
	 * Get the settings option array and print one of its values
	 */
	public function onscribe_fields_products()
	{
		printf(
			'<input type="hidden" id="onscribe_products" name="onscribe[products]" value="%s" />',
			isset( $this->options['products'] ) ? esc_attr( json_encode($this->options['products'], true) ) : ''
		);
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function onscribe_fields_key()
	{
		printf(
			'<input type="text" id="onscribe_key" name="onscribe[key]" value="%s" />',
			isset( $this->options['key'] ) ? esc_attr( $this->options['key']) : ''
		);
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function onscribe_fields_secret()
	{
		printf(
			'<input type="text" id="onscribe_secret" name="onscribe[secret]" value="%s" />',
			isset( $this->options['secret'] ) ? esc_attr( $this->options['secret']) : ''
		);
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function onscribe_fields_title()
	{
		printf(
			'<input type="hidden" id="onscribe_title" name="onscribe[title]" value="%s" />',
			isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
		);
	}


}

if( is_admin() )
	$onscribe_settings = new OnscribeSettings();

?>