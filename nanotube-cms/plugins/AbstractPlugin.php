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
	
	public function render_plugin() {
		$apc = Plugins::get_current_apc();
		$this->render_plugin_content($apc);
	}

	public abstract function render_plugin_content($apc);


}

?>
