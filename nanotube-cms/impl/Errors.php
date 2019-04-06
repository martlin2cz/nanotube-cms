<?php
require_once(__DIR__ . '/dataobj/NanoError.php');

class Errors {

	static private $errors;

	static public function _static_init() {
		self::$errors = Array();
	}

	private function __construct() {
	}

	static public function get_current_errors() {
		return self::$errors;
	}

	static public function is_some_error() {
		 $errors = self::get_current_errors();
		 return !empty($errors);
	}


	static public function add($title, $message, $is_critical) {
		$error = new NanoError($title, $message, $is_critical);
		self::add_error($error);
	}

	static public function add_error($error) {
		self::$errors[] = $error;
	}


	static public function flush_errors() {
		$errors = self::get_current_errors();
		self::clear_errors();
		return $errors;
	}

	static public function clear_errors() {
		self::$errors = Array();
	}


}

Errors::_static_init();
?>
