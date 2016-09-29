<?php

define("PLUGINS_ROOT_DIR", __DIR__ . '/../plugins');

class Plugins {

	private static $current_apc;

	public function __construct() {

	}

	public function load_all_plugins() {
		foreach (glob(PLUGINS_ROOT_DIR . "/*/*.php") as $file) {
			require_once($file);
		}
	}

	public function install() {
		//TODO
		echo "TODO";
		return true;
	}

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
?>
