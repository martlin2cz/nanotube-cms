<?php

require_once(__DIR__ . "/../impl/Plugins.php");
require_once(__DIR__ . "/../impl/database/Configs.php");

define("PLUGIN_STATUS_OK", "ok");
define("PLUGIN_STATUS_INSTALLED", "installed");
define("PLUGIN_STATUS_UNINSTALLED", "uninstalled");


/**
 * Represents plugin. Extend this class to implement custom one.
 * */
abstract class AbstractPlugin {
	private $config;
	private $name;
	private $instances_count;

	/**
	 * Plugin must be initialized with the file and the name of the plugin.
	 * */
	public function __construct($file, $name) {
		$this->config = Configs::get()->get_config();
		$this->name = $name;
		$this->id = Plugins::file_to_id($file); 
		$this->category = Plugins::file_to_category($file); 
		$this->instances_count = 0;
	}
	
	/**
	 * Returns the id of the plugin.
	 * */
	public function get_id() {
		return $this->id;
	}
	
	/**
	 * Returns the category of the plugin.
	 * */
	public function get_category() {
		return $this->category;
	}
	
	/**
	 * Returns the (for-human) name of the plugin.
	 * */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Returns the (long) description of the plugin.
	 * */
	public abstract function get_description();

	/**
	 * Retuns info about usage. Short, please.
	 * */
	public abstract function get_usage();

	/**
	 * Returns PLUGIN_STATUS_OK, PLUGIN_STATUS_INSTALLED or PLUGIN_STATUS_UNINSTALLED
	 * */
	public abstract function get_status();

	/**
	 * Installs the plugin.
	 * */
	public abstract function install();

	/**
	 * Uninstalls the plugin.
	 * */
	public abstract function uninstall();

	/**
	 * Returns true if $this->get_settings_path() exists
	 * */
	public function has_settings() {
		return is_dir(PLUGINS_ROOT_DIR  . "/" . $this->get_settings_path());
	}

	/**
	 * Returns relative (from plugins root dir) path to settings directory of this plugin  (regardless its existence).
	 * */
	public function get_settings_path() {
		return $this->category . "/" . $this->id . "/" . PLUGIN_SETTINGS_DIR_NAME;
	}


	/**
	 * Returns current number of usages of this plugin.
	 * */
	protected function get_instances_count() {
		return $this->instances_count;
	}
	/**
	 * Renders this plugin into page. Can be specified optional params.
	 * */
	public function render_plugin() {
		if ($this->get_status() == PLUGIN_STATUS_UNINSTALLED) {
			?><section class="error">Plugin <?php $this->get_name() ?> not installed.</div><?php
		} else {
			$apc = Plugins::get_current_apc();
			$args = func_get_args();
		
			$this->render_plugin_content($this->config, $apc, $args);
		
			$this->instances_count++;
		}
	}

	/**
	 * Renders the content of the plugin with given config, apc and aditional args.
	 * */
	public abstract function render_plugin_content($config, $apc, $args);

	public function __toString() {
		return "Plugin " . $this->name;
	}

}

?>
