<?php

require_once(__DIR__ . '/../../impl/Errors.php');

define("IDENTIFICATOR_REGEX", '/[a-zA-Z0-9\\-\\:_\\.]+/');
define("PASSWORD_REGEX", '/[a-zA-Z0-9\\-\\!\\?_\\.]+/');

class WebTools {

	static public function format_date($date) {
		return date('j.m.Y, G:i:s', $date);
	}

	static public function format_date_to_input($date) {
		return date('Y-m-j', $date);
	}

	static public function format_only_date($date) {
		return date('j. m. Y', $date);
	}

	static public function require_getted_or_not($key_name) {
		if (isset($_GET) && isset($_GET[$key_name])) {
			return $_GET[$key_name];
		} else {
			return null;
		}
	}
	
	static public function require_posted_id($key_name, $allow_empty) {
		$value = self::require_value($_POST, $key_name, false);
		return self::require_id($key_name, $value, $allow_empty);
	}


	static public function require_posted_string($key_name, $allow_empty) {
		$value = self::require_value($_POST, $key_name, false);
		return self::require_string($key_name, $value, $allow_empty);
	}

	static public function require_posted_number($key_name, $min, $max) {
		$value = self::require_value($_POST, $key_name, false);
		return self::require_number($key_name, $value, $min, $max);
	}

	
	static public function require_posted_password($key_name, $allow_empty) {
		$value = self::require_value($_POST, $key_name, false);
		return self::require_password($key_name, $value, $allow_empty);
	}


	static public function require_posted_date($key_name, $allow_empty) {
		$value = self::require_value($_POST, $key_name, false);
		return self::require_date($key_name, $value, $allow_empty);
	}


	static public function require_getted_id($key_name, $allow_empty) {
		$value = self::require_value($_GET, $key_name, false);
		return self::require_id($key_name, $value, $allow_empty);
	}

	static public function require_getted_string($key_name, $allow_empty) {
		$value = self::require_value($_GET, $key_name, false);
		return self::require_string($key_name, $value, $allow_empty);
	}

	static public function require_posted_bool($key_name) {
		$value = self::require_value($_POST, $key_name, true);
		return $value;
	}

	static private function require_value($method, $key_name, $allow_undefined) {
		if (isset($method) && isset($method[$key_name])) {
			return $method[$key_name];
		} else {
			if (!$allow_undefined) {
				Errors::add("Params error", "Missing param $key_name", false);
			}
			return null;
		}
	}


	static private function require_id($key_name, $value, $allow_empty) {
		if ($allow_empty && $value == '') {
			return null;
		}

		$match = preg_match(IDENTIFICATOR_REGEX, $value);
		if (!$match) {
			Errors::add("Params error", "Param $key_name must be (nonepty) identificator", false);
			return null;
		}

		return $value;
	}

	static private function require_string($key_name, $value, $allow_empty) {
		if (!$allow_empty && $value == '') {
			Errors::add("Params error", "Param $key_name must be (nonepty) string", false);
			return null;
		}

		return $value;
	}

	static private function require_number($key_name, $value, $min, $max) {
		if ($value == '') {
			Errors::add("Params error", "Param $key_name must be (nonepty) number", false);
			return null;
		}

		if ($value < $min || $value > $max) {
			Errors::add("Params error", "Param $key_name must be greater than $min and less than $max", false);
			return null;
		}

		return $value;
	}

	static private function require_date($key_name, $value, $allow_empty) {
		if (!$allow_empty && $value == '') {
			Errors::add("Params error", "Param $key_name must be date", false);
			return null;
		}

		return strtotime($value);
	}


	static private function require_password($key_name, $value, $allow_empty) {
		if ($allow_empty && $value == '') {
			return null;
		}

		$match = preg_match(PASSWORD_REGEX, $value);
		$long = strlen($value) > 30;
		$short = strlen($value) < 5;
		if (!$match || $long || $short) {
			Errors::add("Params error", "Password has to have from 5 to 30 chars and cannot contain special characters.", false);
			return null;
		}

		return $value;
	}


}
?>
