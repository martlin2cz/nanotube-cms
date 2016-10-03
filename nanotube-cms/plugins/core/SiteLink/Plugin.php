<?php

require_once(__DIR__ . '/../../AbstractPlugin.php');
require_once(__DIR__ . '/../../../impl/Tools.php');

class SiteLinkPlugin extends AbstractPlugin {

	public function __construct() {
		parent::__construct(__FILE__, 'Site link');
	}

	public function get_description() {
		return "Simple plugin allows to insert links to sites acros the web.";
	}

	public function get_usage() {
		return "Insert <code>&lt;?php plugin_LinkToSite('site id', 'text of link'); ?&lt;</code> wherever you want.";	
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
		$site_id = $args[0];
		$text = $args[1];

		?> <a href="<?= Tools::make_link($site_id)?>"><?= $text ?></a><?php
	}

	static public function put($site_id, $text) {
		$plugin = new SiteLinkPlugin();
		$plugin->render_plugin($site_id, $text);	
	}
}

function plugin_LinkToSite($site_id, $text) {
	SiteLinkPlugin::put($site_id, $text);
}

?>
