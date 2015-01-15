<?php
namespace {
// global scope
	class Onscribe {

		function __construct( $key, $secret ){

			// authenticate

			// interface
			$this->get = new \Onscribe\GET();
			$this->post = new \Onscribe\POST();
			$this->put = new \Onscribe\PUT();
			$this->delete = new \Onscribe\DELETE();
		}

		private function auth(){

		}

	}
}

namespace Onscribe {
	$api = "https://onscri.be/api/v1/";

	class GET {

		public function products($id=false){
			if( !$id ); // get all
			$this->https("products");

		}

		public function subscriptions($id=false){
			if( !$id ); // get all

		}

	}
	class POST {
		// currently not supported
	}
	class PUT {
		// currently not supported
	}
	class DELETE {
		// currently not supported
	}

	// Helpers
	// - handles all remote requests
	function https( $path=false, $data=array(), $method="GET" ){
		// prerequisites
		if (!function_exists('curl_init')) return;
		if( !$path ) return;

		// create a new cURL resource handle
		$ch = curl_init();

		// Now set some options (most are optional)

		// Set URL to download
		curl_setopt($ch, CURLOPT_URL, $Url);

		// Include header in result? (0 = yes, 1 = no)
		curl_setopt($ch, CURLOPT_HEADER, 0);

		// Should cURL return or print out the data? (true = return, false = print)
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Timeout in seconds
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		// Download the given URL, and return output
		$output = curl_exec($ch);

		// Close the cURL resource, and free system resources
		curl_close($ch);

		return $output;
	}

}

?>