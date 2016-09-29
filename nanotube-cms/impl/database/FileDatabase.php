<?php

require_once(__DIR__ . '/../dataobj/Config.php');

class FileDatabase {
	private $file;

	public function __construct($file) {
		$this->file = $file;
	}

	private function get_path() {
		$path = __DIR__ . "/../../../" . $this->file;
		return $path;
	}

	public function load() {
		$path = $this->get_path();
		$code = file_get_contents($path);
		$code = " ?> \n$code \n<?php ";
		$value = eval($code);

		if (!$value) {
			//Errors::add("File database error", "Cannot open file " . $this->file, true);
			error_log("FileDB: cannot load file");
		}
		return $value;
	}

	public function create() {
		$path = $this->get_path();
		$code = "<?php /* code generated by FileDatabase */ ?>\n";
		$code .= "<?php /* HERE WILL GO DATA CODE */ ?>\n";

		$succ = file_put_contents($path, $code);
	
		if (!$succ) {
			//Errors::add("File database error", "Cannot create file " . $this->file, true);
			error_log("FileDB: cannot create file");
		}
		return $succ;
	}

	public function remove() {
		$path = $this->get_path();		
		$deleted = unlink($path);

		if (!$deleted) {
			//Errors::add("File database error", "Cannot delete file " . $this->file, true);
			error_log("FileDB: cannot remove file");
		}
		return $deleted;
	}

	public function save($code) {
		$path = $this->get_path();
		$code = "<?php /* Saved by FileDatabase */ ?>\n$code";
	
		$putted = file_put_contents($path, $code);
	
		if (!$putted) {
			//Errors::add("File database error", "Cannot write file " . $this->file, true);
			error_log("FileDB: cannot save file");
		}
		return $putted;
	}

	public function save_constructored($class_name, $var_name, $attrs) {
		$code = "<?php /* code generated by FileDatabase */ ?>\n";
		$code .= "<?php\n";
		//$code .= "global \$$var_name;\n";
		$code .= "\$$var_name = new $class_name(";

		$count = count($attrs);
		foreach ($attrs as $index => $attr) {
			$code .= $this->value_to_php_string($attr);
			
			if ($index + 1 < $count) {
				$code .= ", ";
			}
		}
		$code .= ");\n";
		$code .= "return \$$var_name;\n";
		$code .= "?>\n";

		return $this->save($code);
	}

	public function save_settered($class_name, $var_name, $attrs) {
		$code = "<?php /* code generated by FileDatabase */ ?>\n";
		$code .= "<?php\n";
		//$code .= "global \$$var_name;\n";
		$code .= "\$$var_name = new $class_name();\n\n";

		foreach ($attrs as $name => $value) {
			$code .= "\$$var_name -> set_$name (" . $this->value_to_php_string($value) . ");\n";
		}
		$code .= "\n";
		$code .= "return \$$var_name;\n";
		$code .= "?>\n";

		return $this->save($code);
	}

	private function value_to_php_string($value) {
		if (is_string($value)) {
			return "'" . str_replace("'", "\\'", $value) . "'";
		} else if ($value === null) {
			return "null";
		} else if ($value === false) {
			return "false";
		} else {
			return $value;
		}
	}

}
