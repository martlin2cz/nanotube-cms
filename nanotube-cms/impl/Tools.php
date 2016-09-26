<?php

require_once(__DIR__ . '/database/Sites.php');

define("SITE_ID_GET_PARAM_NAME", "id");

class Tools {
	static private $sites;

	private function __construct() {
	}

	static public function _static_init() {
		self::$sites = new Sites();
	}


	static public function start_capturing_output() {
		ob_start();
	}
	
	static public function finish_capturing_output() {
		$string = ob_get_clean();
		return $string;
	}


	static public function run_html_with_php($apc, $php) {
		$wrapped_php = " ?> " . $php . " <?php ";
		try {
			eval($wrapped_php); // !!!
		} catch (Exception $exception) {
			echo "\n<div class='nm-error'>" . $exception . "</div>\n"; //TODO error handling
		}
	}

	static public function render_string($string) {
		echo $string;
	}

	static public function render_array($array) {
		self::render_string("\n");

		foreach ($array as $string) {
			self::render_string($string);
			self::render_string("\n");
		}
	}

	static public function current_site_by_url() {
			
		$site_id = self::current_site_id_by_url();

		if (is_null($site_id)) {
			return self::$sites->index_site();
		} else {
			return self::try_find_site_by_id($site_id);
		}

	}

	static private function current_site_id_by_url() {
		if (!isset($_GET) || !isset($_GET[SITE_ID_GET_PARAM_NAME])) {
			return null;
		}

		return $_GET[SITE_ID_GET_PARAM_NAME];
	}
	
	static private function try_find_site_by_id($site_id) {
		$site = self::$sites->get_site($site_id);

		if ($site) {
			return $site;
		} else {
			return self::$sites->error_404_site();
		}
	}

	static public function redirect_to_relative($relative) {
		$absolute = dirname($_SERVER['REQUEST_URI']) . '/' . $relative;
//		echo "--- REDIRECTING TO " . $_SERVER['REQUEST_URI'] . " 'S " . $relative . " ---> $absolute ---";
				header('Location: ' . $absolute);
	}

}

Tools::_static_init();

?>
