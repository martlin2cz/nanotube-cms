<?php

require_once(__DIR__ . '/NAtemplate.php');
require_once(__DIR__ . '/../../impl/Errors.php');
require_once(__DIR__ . '/../../impl/Tools.php');
require_once(__DIR__ . '/../../impl/LogingIn.php');


class ActionTemplate {
	
	static private $path_to_root;


	static public function before_start($path_to_root, $required_login) {
		self::$path_to_root = $path_to_root;

		if ($required_login) {
			if (LogingIn::get()->is_not_logged()) {
				Errors::add("Authorisation failure", "You must be logged in to perform this operation", true);
			}
		}
	
		self::check_errors();
	}

	static public function check_errors() {
		if (Errors::is_some_error()) {
			$errors = Errors::flush_errors();
			self::do_error_page($errors);
		}
	}

	static private function do_error_page($errors) { ?>
		<?php NAtemplate::before_content(self::$path_to_root, "An error(s) occured", null, ''); ?>

		<h1>An error(s)	occured</h1>
		<?php foreach ($errors as $error) { ?>
			<?php NAtemplate::do_error($error); ?>
		<?php } ?>
		<button onclick="history.back()">Back</button>

		<?php NAtemplate::after_content(); ?>
		<?php die("<!-- That's all folks -->"); ?>
		<?php }
		
	static public function success($redirect_to) {
		Tools::redirect_to_relative($redirect_to);
		echo "OK";
	}
}
?>
