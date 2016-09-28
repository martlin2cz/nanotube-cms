<?php

require_once(__DIR__ . '/../../impl/Errors.php');

define("IDENTIFICATOR_REGEX", '/[a-zA-Z0-9\\-_\\.]+/');

class WebTools {

	static public function require_posted_id($key_name, $allow_empty) {
		if (isset($_POST) && isset($_POST[$key_name])) {
			$value = $_POST[$key_name];
		} else {
			Errors::add("Params error", "Missing POST param $key_name", false);
			return;
		}

		if ($allow_empty && $value == '') {
			return;
		}

		$match = preg_match(IDENTIFICATOR_REGEX, $value);
		if (!$match) {
			Errors::add("Params error", "Param $key_name must be (nonepty) identificator", false);
			return;
		}
	}


	static public function require_posted_string($key_name, $allow_empty) {
		if (isset($_POST) && isset($_POST[$key_name])) {
			$value = $_POST[$key_name];
		} else {
			Errors::add("Params error", "Missing POST param $key_name", false);
			return;
		}

		if (!$allow_empty && $value == '') {
			Errors::add("Params error", "Param $key_name must be (nonepty) string", false);
			return;

		}
	}

}
