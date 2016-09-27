<?php

define("IDENTIFICATOR_REGEX", '/[a-zA-Z0-9\\-_\\.]+/');

class WebTools {

	static public function require_posted_id($key_name, $allow_empty) {
		if (isset($_POST) && isset($_POST[$key_name])) {
			$value = $_POST[$key_name];
		} else {
			self::web_error("Params error", "Missing POST param $key_name");
			return;
		}

		if ($allow_empty && $value == '') {
			return;
		}

		$match = preg_match(IDENTIFICATOR_REGEX, $value);
		if (!$match) {
			self::web_error("Params error", "Param $key_name must be (nonepty) identificator");
			return;
		}
	}


	static public function require_posted_string($key_name, $allow_empty) {
		if (isset($_POST) && isset($_POST[$key_name])) {
			$value = $_POST[$key_name];
		} else {
			self::web_error("Params error", "Missing POST param $key_name");
			return;
		}

		if (!$allow_empty && $value == '') {
			self::web_error("Params error", "Param $key_name must be (nonepty) string");
			return;

		}
	}


	static public function web_error($title, $message) {
		echo "<div class=\"error\"><h1>$title</h1><p>$message</p><button onclick=\"history.back()\">Back</button></div>";
		die();
	}


}
