<?php

require_once(__DIR__ . '/../../AbstractPlugin.php');
require_once(__DIR__ . '/../../../impl/database/Sites.php');
require_once(__DIR__ . '/../../../impl/Tools.php');


class MenuPlugin extends AbstractPlugin {
	private $sites;

	public function __construct() {
		parent::__construct(__FILE__, 'Menu');
		$this->sites = Sites::get();
	}

	public function get_description() {
		return "The menu plugin. Can be placed in template or also in the site.";
	}

	public function get_usage() {
		return "<code>&lt;?php plugin_Menu(); ?&gt;</code>";	
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

	public function render_plugin_content($config, $apc, $args) { ?>
		<ol>
		<?php foreach ($this->sites->all_sites() as $site) { ?>
			<li><a href="<?= Tools::make_link($site->get_id()) ?>"><?= $site->get_title() ?></a></li>
		<?php } ?>
		</ol>
	<?php }

	static public function put() {
		$plugin = new MenuPlugin();
		$plugin->render_plugin();	
	}
}

function plugin_Menu() {
	MenuPlugin::put();
}

?>
