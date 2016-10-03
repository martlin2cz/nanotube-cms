<?php

require_once(__DIR__. '/../impl/database/Admins.php');
require_once(__DIR__. '/Passwording.php');


define('LOGGED_USER_SESSION_VAR_NAME', 'nta-logged-user');

class LogingIn {

	private static $instance;

	private $admins;
	private $passwording;

	/// initialization of singleton /////////////////////////////////////////////
	protected function __construct() {
		session_start();
		$this->admins = Admins::get();
		$this->passwording = new Passwording();
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

	public function logged_admin() {
		$username = $_SESSION[LOGGED_USER_SESSION_VAR_NAME];
		$admin = $this->admins->get_admin($username);
		return $admin;
	}
	/// log in and out /////////////////////////////////////////////

	public function log_in($admin) {
		$username = $admin->get_username();
		$_SESSION[LOGGED_USER_SESSION_VAR_NAME] = $username;
	}


	public function log_out() {
		unset($_SESSION[LOGGED_USER_SESSION_VAR_NAME]);
		session_unset();
		session_destroy();
	}

	/// authorisation /////////////////////////////////////////////

	public function check_credentials($username, $password) {
		$admin = $this->admins->get_admin($username);
		if (!$admin) {
			return null;
		}
		
		if (!$admin->is_enabled()) {
			return null;
		}


		$match = $this->passwording->matches($password, $admin->get_password(), $admin->get_password_salt());
		if (!$match) {
			return null;
		}
		
		return $admin;
	}	
}

LogingIn::initialize_instance();

?>
