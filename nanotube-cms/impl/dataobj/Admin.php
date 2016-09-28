<?php

class Admin {
	private $username;
	private $full_name;
	//TODO
	
	public function __construct($username, $full_name) {
		$this->username = $username;
		$this->full_name = $full_name;
	}

	
	public function get_username() {
		return $this->username;
	}
	
	public function get_full_name() {
		return $this->full_name;
	}

}

