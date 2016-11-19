<?php

require_once(__DIR__ . '/../dataobj/Config.php');
require_once(__DIR__ . '/../database/FileDatabase.php');
require_once(__DIR__ . '/../Errors.php');
require_once(__DIR__ . '/../Passwording.php');

define("CONFIG_FILE_PATH", "config/nanoconfig.php");

class Configs {
	static private $instance;

	private $config;

	static public function _static_init() {
		self::$instance = new Configs();
	}

	static public function get() {
		return //new Configs(); 
			self::$instance;
	}

	public function __construct() {
		$this->config = $this->try_load();
	}

	public function get_config() {
		return $this->config;
	}

	public function try_reload_config() {
		$this->config = $this->try_load();
	}

	public function reload_config() {
		$this->config = $this->load();
	}

	public function save_config($config) {
		$this->config = $config;
		return $this->save($this->config);
	}

	private function try_load() {
		$db = new FileDatabase(CONFIG_FILE_PATH);
		$config = $db->load();

		if (!$config) {
			$config = $this->create_default();
		}

		return $config;
	}

	private function create_default() {
		$config = new Config();
		$config->set_web_title("Web");
		
		$passwording = new Passwording();
		$hash = $passwording->generate_password_hash("his_nano_password");
		$config->set_na_password($hash[0]);		
		$config->set_na_password_salt($hash[1]);		

		return $config;
	}

	private function load() {
		$db = new FileDatabase(CONFIG_FILE_PATH);
		$config = $db->load();

		if (!$config) {
			Errors::add("Config file", "Cannot load config file", true);
			return false;
		}

		return $config;
	}

	private function create() {
		$db = new FileDatabase(CONFIG_FILE_PATH);
		$succ = $db->create();

		if (!$succ) {
			Errors::add("Config file", "Cannot create config file", true);
			return false;
		}

		return new Config();
	}

	private function save($config) {
		$data = Array(
			'web_title' => 				$config->get_web_title(),
			'web_description' => 	$config->get_web_description(),
			'web_keywords' => 		$config->get_web_keywords(),
			'mysql_server' => 		$config->get_mysql_server(),
			'mysql_database' => 	$config->get_mysql_database(),
			'mysql_user' => 			$config->get_mysql_user(),
			'mysql_password' => 	$config->get_mysql_password(),
			'na_password' => 			$config->get_na_password(),
			'na_password_salt' => $config->get_na_password_salt()
		);

		$db = new FileDatabase(CONFIG_FILE_PATH);
		$succ = $db->save_settered("Config", "config", $data);	

		if (!$succ) {
			Errors::add("Config file", "Cannot save config file", true);
		}
		return $succ;
	}

	public function __toString() {
		return "Configs: " . $this->config->_toString();
	}
}

Configs::_static_init();

?>
