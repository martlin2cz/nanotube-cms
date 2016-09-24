<?php

require_once(__DIR__ . '/../AbstractPlugin.php');

class HelloWorldPlugin extends AbstractPlugin {
	private $text;

	public function __construct($text) {
		parent::__construct('Hello World');
		$this->text = $text;
	}

	public function get_description() {
		return "A simple plugin testing and demonstrating how plugins in <em>nanotube-cms</em> works.";
	}

	public function get_usage() {
		return "Insert <code><?php plugin_HelloWorld('the text you wish to display'); ?></code> wherever you want.";	
	}

	public function render_plugin_content($apc) {
		echo $this->text;
		
		$apc->add_head('<!-- this head comment was added by Hello World plugin -->');
		$apc->add_before_content('<!-- this body starting comment was added by Hello World plugin -->');
		$apc->add_after_content('<!-- this body ending comment was added by Hello World plugin -->');
		$apc->set_title_suffix(', with Hello World plugin!');
	}

	static public function put($text) {
		$plugin = new HelloWorldPlugin($text);
		$plugin->render_plugin();	
	}
}

function plugin_HelloWorld($text) {
	HelloWorldPlugin::put($text);
}

?>
