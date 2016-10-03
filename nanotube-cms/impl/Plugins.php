<?php
require_once(__DIR__ . '/database/Configs.php'); 

define("PLUGINS_ROOT_DIR", __DIR__ . '/../plugins');
define("PLUGIN_CLASS_FILE_NAME", "Plugin.php");
define("PLUGIN_SETTINGS_DIR_NAME", "settings");


class Plugins {
	static private $instance;
	private $plugins;
	private static $current_apc;

	public function __construct() {
		$this->plugins = $this->load_plugins();
	}

	static public function get() {
		return self::$instance;
	}

	static public function _static_init() {
		self::$instance = new Plugins();
	}

	// querying

	public function all_plugins() {
		return $this->plugins;
	}

	public function get_plugin($id) {
		if (isset($this->plugins[$id])) {
			return $this->plugins[$id];
		} else {
			return null;
		}
	}

	public function has_plugin_settings($plugin_id) {
		return count(glob(PLUGINS_ROOT_DIR . "/*/" . $plugin_id . "/" . PLUGIN_SETTINGS_DIR_NAME)) > 0;
	}

	// loading plugins

	private function load_plugins() {
		$config = Configs::get()->get_config();
		$plugins = Array();
		
		$files = glob(PLUGINS_ROOT_DIR . "/*/*/" . PLUGIN_CLASS_FILE_NAME);
		foreach ($files as $file) {
			$id = self::file_to_id($file);
			$class_name = $this->id_to_class_name($id);
			
			$done = include_once($file);
			if (!$done) {
				Errors::add("Plugin error", "Plugin $id contains some errors.");
				continue;
			}

			$instance = new $class_name($config);
			$plugins[$id] = $instance;
		}

		return $plugins;
	}

	static public function file_to_category($file) {
		$id_dir = dirname($file);
		$category_dir = dirname($id_dir);
		$slash_at = strrpos($category_dir, '/');
		$trimmed = substr($category_dir, $slash_at + 1);
		return $trimmed;	
	}
	static public function file_to_id($file) {
		$dir = dirname($file);
		$slash_at = strrpos($dir, '/');
		$trimmed = substr($dir, $slash_at + 1);
		return $trimmed;	
	}

	private function id_to_class_name($id) {
		return $id . "Plugin";	
	}

	// using plugins in pages

	static public function start_using_plugins($apc) {
		self::$current_apc = $apc;
	}

	static public function finish_using_plugins() {
		self::$current_apc = null;
	}

	static public function get_current_apc() {
		return self::$current_apc;
	}

}

Plugins::_static_init();
?>
