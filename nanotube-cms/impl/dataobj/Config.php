<?php

class Config {
	private $web_title;
	private $web_description;
	private $web_keywords;
	
	private $mysql_server;
	private $mysql_database;
	private $mysql_user;
	private $mysql_password;

	private $na_password;
	private $na_password_salt;
	private $links_format;

	public function __construct() {
	}

	// getters

	public function get_web_title() {
		return $this->web_title;
	}

	public function get_web_description() {
		return $this->web_description;
	}

	public function get_web_keywords() {
		return $this->web_keywords;
	}

	public function get_mysql_server() {
		return $this->mysql_server;
	}

	public function get_mysql_database() {
		return $this->mysql_database;
	}

	public function get_mysql_user() {
		return $this->mysql_user;
	}

	public function get_mysql_password() {
		return $this->mysql_password;
	}

	// setters

	public function set_web_title($web_title) {
		$this->web_title = $web_title;
	}

	public function set_web_description($web_description) {
		$this->web_description = $web_description;
	}

	public function set_web_keywords($web_keywords) {
		$this->web_keywords = $web_keywords;
	}

	public function set_mysql_server($mysql_server) {
		$this->mysql_server = $mysql_server;
	}

	public function set_mysql_database($mysql_database) {
		$this->mysql_database = $mysql_database;
	}

	public function set_mysql_user($mysql_user) {
		$this->mysql_user = $mysql_user;
	}
	
	public function set_mysql_password($mysql_password) {
		$this->mysql_password = $mysql_password;
	}

	// others
	
	public function __toString() {
		return "Web config, web_title=" . $this->web_title . ", ...";
	}
}



?>
