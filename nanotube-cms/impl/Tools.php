<?php

require_once(__DIR__ . '/database/Configs.php');
require_once(__DIR__ . '/database/Sites.php');

define("SITE_ID_GET_PARAM_NAME", "site");
define("LINKS_FORMAT_PATTERNER", "SITE_ID");
define("TEMPLATES_DIR", "templates/");
define("TEMPLATE_CLASS_NAME", "MyTemplate");



class Tools {
	static private $config;
	static private $sites;

	private function __construct() {
	}

	static public function _static_init() {
		self::$config = Configs::get()->get_config();
		self::$sites = Sites::get();
		self::include_template_file();
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
			echo "\n<div class='nt-error'>" . $exception . "</div>\n"; //TODO error handling
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

	static private function include_template_file() {
		$root = __DIR__ . "/../../";
		$file = $root . TEMPLATES_DIR . TEMPLATE_CLASS_NAME . ".php";
		require_once($file);
	}

	static public function get_template() {
		$class_name = TEMPLATE_CLASS_NAME;
		$instance = new $class_name(self::$config);

		return $instance;
	}

	static public function make_link($site_id) {
		$template = self::get_template();
		$format = $template->get_links_format();
		return str_replace(LINKS_FORMAT_PATTERNER, $site_id, $format);
	}

	static public function redirect_to_relative($relative) {
		$url = $_SERVER['PHP_SELF'];
		if (self::ends_with($url, ".php") || self::ends_with($url, ".html")) {
			$dir = dirname($url);
		} else {
			$dir = preg_replace('/\\/$/', '', $url);
		}	
		//echo "--" . $_SERVER['PHP_SELF'] . "--";

		$absolute = $dir . '/' . $relative;
		header('Location: ' . $absolute);
		die("\nHastala vista, baby! (Redirecting to $relative)");
	}

	static private function ends_with($string, $ending) {
		return substr($string, - strlen($ending)) == $ending;
	}

}

Tools::_static_init();

?>
