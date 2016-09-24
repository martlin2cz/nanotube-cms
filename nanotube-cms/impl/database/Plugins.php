<?php

define("PLUGINS_ROOT_DIR", __DIR__ . '/../../plugins');

class Plugins {


	public function __construct() {

	}

	public function load_all_plugins() {
		foreach (glob(PLUGINS_ROOT_DIR . "/*/*.php") as $file) {
			require_once($file);
		}
	}
}
?>
