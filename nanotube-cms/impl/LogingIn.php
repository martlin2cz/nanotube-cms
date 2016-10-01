<?php

require_once(__DIR__. '/../impl/database/Admins.php');

define('LOGGED_USER_SESSION_VAR_NAME', 'nta-logged-user');

class LogingIn {

	private static $instance;

	private $admins;

	/// initialization of singleton /////////////////////////////////////////////
	protected function __construct() {
		session_start();
		$this->admins = Admins::get();
	}

	static public function initialize_instance() {
		self::$instance = new LogingIn();	
	}

	static public function get() {
		return self::$instance;	
	}

	/// querying /////////////////////////////////////////////

	public function is_logged_in() {
		return isset($_SESSION) && isset($_SESSION[LOGGED_USER_SESSION_VAR_NAME]);
	}

	public function is_not_logged() {
		return !$this->is_logged_in();
	}

	public function logged_user() {
		//return $_SESSION[LOGGED_USER_SESSION_VAR_NAME];//TODO
		return Admins::get()->get_admin($_SESSION[LOGGED_USER_SESSION_VAR_NAME])->get_username();
	}
	/// log in and out /////////////////////////////////////////////

	public function log_in() {
		$_SESSION[LOGGED_USER_SESSION_VAR_NAME] = NANOADMIN_USERNAME;
	}


	public function log_out() {
		unset($_SESSION[LOGGED_USER_SESSION_VAR_NAME]);
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
