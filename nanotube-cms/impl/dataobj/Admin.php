<?php

class Admin {
	private $username;
	private $full_name;
	private $password;
	private $password_salt;
	private $enabled;
	private $last_login_at;
	private $registered_at;
	
	public function __construct($username, $full_name, $password, $password_salt, $enabled, $last_login_at, $registered_at) {
		$this->username = $username;
		$this->full_name = $full_name;
		$this->password = $password;
		$this->password_salt = $password_salt;
		$this->enabled = $enabled;
		$this->last_login_at = $last_login_at;
		$this->registered_at = $registered_at;
	}

	// getters

	public function get_username() {
		return $this->username;
	}
	
	public function get_full_name() {
		return $this->full_name;
	}

	public function get_password() {
		return $this->password;
	}
	
	public function get_password_salt() {
		return $this->password_salt;
	}

	public function is_enabled() {
		return $this->enabled;
	}

	public function get_last_login_at() {
		return $this->last_login_at;
	}

	public function get_registered_at() {
		return $this->registered_at;
	}

	// setters

	public function set_username($username) {
		$this->username = $username;
	}

	public function set_full_name($full_name) {
		$this->full_name = $full_name;
	}

	public function set_password($password) {
		$this->password = $password;
	}
	
	public function set_password_salt($password_salt) {
		$this->password_salt = $password_salt;
	}
	
	public function set_enabled($enabled) {
		$this->enabled = $enabled;
	}
	
	public function set_last_login_at($last_login_at) {
		$this->last_login_at = $last_login_at;
	}
	
	public function set_registered_at($registered_at) {
		$this->registered_at = $registered_at;
	}

	// others

	public function __toString() {
		return "Admin: " . $this->username;
	}







}

