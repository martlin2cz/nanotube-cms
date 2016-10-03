<?php

require_once(__DIR__ . '/../../AbstractPlugin.php');

class HelloWorldPlugin extends AbstractPlugin {

	public function __construct() {
		parent::__construct(__FILE__, 'Hello World');
	}

	public function get_description() {
		return "A simple plugin testing and demonstrating how plugins in <em>nanotube-cms</em> works.";
	}

	public function get_usage() {
		return "Insert <code>&lt;?php plugin_HelloWorld('the text you wish to display'); ?&gt;</code> wherever you want.";	
	}

  public function get_status() {
    return PLUGIN_STATUS_OK;
  }

  public function install() {
    return true;
  }
  
  public function uninstall() {                                                                                                        
    return true;
  }


	public function render_plugin_content($config, $apc, $args) {
		$text = $args[0];

		echo $text;	//here finally outputs the text
		
		$apc->add_head('<!-- this head comment was added by Hello World plugin -->');
		$apc->add_before_content('<!-- this body starting comment was added by Hello World plugin -->');
		$apc->add_after_content('<!-- this body ending comment was added by Hello World plugin -->');
		$apc->set_title_suffix(', with Hello World plugin!');
	}

	static public function put($text) {
		$plugin = new HelloWorldPlugin();
		$plugin->render_plugin($text);	
	}
}

function plugin_HelloWorld($text) {
	HelloWorldPlugin::put($text);
}

?>
