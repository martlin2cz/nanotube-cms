<?php

define('LOGIN_SESSION_VAR_NAME', 'NTA_SESSION_ID');

class LogingIn {

	private static $instance;

	/// initialization of singleton /////////////////////////////////////////////
	protected function __construct() {
		session_start();
	}

	static public function initialize_instance() {
		self::$instance = new LogingIn();	
	}

	static public function get() {
		return self::$instance;	
	}

	/// querying /////////////////////////////////////////////

	public function is_logged_in() {
		return isset($_SESSION) && isset($_SESSION[LOGIN_SESSION_VAR_NAME]);
	}

	public function is_not_logged() {
		return !$this->is_logged_in();
	}

	/// log in and out /////////////////////////////////////////////

	public function log_in() {
		$_SESSION[LOGIN_SESSION_VAR_NAME] = rand();
	}


	public function log_out() {
		unset($_SESSION[LOGIN_SESSION_VAR_NAME]);
		session_unset();
		session_destroy();
	}

	/// authorisation /////////////////////////////////////////////

	public function is_login_valid($username, $password) {
		//TODO
		return true;
	}	
}

LogingIn::initialize_instance();

?>
