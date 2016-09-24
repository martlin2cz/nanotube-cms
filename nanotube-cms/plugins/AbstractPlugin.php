<?php
abstract class AbstractPlugin {
	private $name;

	public function __construct($name) {
		//TODO
	}

	public function get_name() {
		return $name;
	}

	public abstract function get_description();

	public abstract function get_usage();
	
	public abstract function render_plugin($apc);
}

?>
