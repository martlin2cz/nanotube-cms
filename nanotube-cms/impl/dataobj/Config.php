<?php

class Config {
	private $web_title;

	public function __construct($web_title) {
		$this->web_title = $web_title;
	}

	public function get_web_title() {
		return $this->web_title;
	}

	public function get_mysql_server() {
		return "localhost";
	}

	public function get_mysql_database() {
		return "nanotube_dev";
	}

	public function get_mysql_user() {
		return "nanotube_db_user";
	}

	public function get_mysql_password() {
		return "his_nano_password";
	}


	//TODO modify
	
	public function __toString() {
		return "Web config, web_title=" . $this->web_title;
	}
}



?>
