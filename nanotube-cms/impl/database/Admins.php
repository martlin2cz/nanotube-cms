<?php

require_once(__DIR__. '/../dataobj/Admin.php');

class Admins {
	private $admins;

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

	public function __toString() {
		return "Admins: " . count($this->admins);
	}
}



?>
