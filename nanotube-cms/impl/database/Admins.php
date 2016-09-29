<?php

require_once(__DIR__. '/../dataobj/Admin.php');

class Admins {
	static private $instance;

	private $admins;

	static public function _static_init() {
		self::$instance = new Admins();
	}

	static public function get() {
		return self::$instance;
	}


	public function __construct() {
	
		$this->admins = Array(
			'na' => new Admin('na', "Nano Admin")
		);
	}

	public function all_admins() {
		return $this->admins;
	}
	
	public function get_admin($username) {
		return $this->admins[$username];
	}
	
	public function install() {
	 	//TODO
		echo "TODO";
		return true;
	}

	public function __toString() {
		return "Admins: " . count($this->admins);
	}
}

Admins::_static_init();



?>
