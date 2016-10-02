<?php

require_once(__DIR__ . '/NAtemplate.php');
require_once(__DIR__ . '/../../impl/Errors.php');
require_once(__DIR__ . '/../../impl/Tools.php');
require_once(__DIR__ . '/../../impl/LogingIn.php');


class ActionTemplate {
	
	static private $path_to_root;
	static private $before_content_yet_done;

	static public function before_start($path_to_root, $required_login) {
		self::$path_to_root = $path_to_root;

		if ($required_login) {
			if (LogingIn::get()->is_not_logged()) {
				Errors::add("Authorisation failure", "You must be logged in to perform this operation", true);
			}
		}
	
		//self::check_errors();
		self::warn_errors();
	}

	static public function check_errors() {
		if (Errors::is_some_error()) {
			$errors = Errors::flush_errors();
			self::do_error_page($errors);
		}
	}
	
	static public function warn_errors() {
		if (Errors::is_some_error()) {
			$errors = Errors::flush_errors();
			self::do_warning_page($errors);
		}
	}

	static private function do_error_page($errors) {
		if (!self::$before_content_yet_done) { 
			NAtemplate::before_content(self::$path_to_root, "An error(s) occured", null, '');
			self::$before_content_yet_done = true;
		}
		 
		foreach ($errors as $error) {
			NAtemplate::do_error($error);
		}

		NAtemplate::after_content();
		die("<!-- That's all folks -->");
	}

	static private function do_warning_page($errors) {
		if (!self::$before_content_yet_done) { 
			NAtemplate::before_content(self::$path_to_root, "An error(s) occured", null, '');
			self::$before_content_yet_done = true;
		}

		$error = new Error("Some errors occured", "Following errors occured. This is not fatal, but the requested operation may be not completed successfully.", false);
		NAtemplate::do_error($error);

		foreach ($errors as $error) {
			NAtemplate::do_error($error);
		}
	}
		
	static public function success($redirect_to) {
		Tools::redirect_to_relative($redirect_to);
		echo "OK";
	}
}
?>
