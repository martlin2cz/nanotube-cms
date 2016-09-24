<?php

require_once(__DIR__ . '/../AbstractPlugin.php');
require_once(__DIR__ . '/../../impl/database/Sites.php');

define("SITE_ID_FORMAT_SEQ", '$site-id');

class MenuPlugin extends AbstractPlugin {
	private $format;
	private $sites;

	public function __construct($format) {
		parent::__construct('Menu');
		$this->format = $format;
		$this->sites = new Sites();
	}

	public function get_description() {
		return "The menu plugin. Can be placed in template or also in the site.";
	}

	public function get_usage() {
		return "<code><?php plugin_Menu(\$apc, 'links format'); ?></code>, where <code>links format</code> should be like: <code>/\$site-id</code> or <code>/?page=\$site-id</code>";	
	}

	public function render_plugin_content($apc) { ?>
		<ol>
		<?php foreach ($this->sites->all_sites() as $site) { ?>
			<li><a href="<?= $this->make_url($site) ?>"><?= $site->get_title() ?></a></li>
		<?php } ?>
		</ol>
	<?php }

	private function make_url($site) {
		return str_replace(SITE_ID_FORMAT_SEQ, $site->get_id(), $this->format);
	}

	static public function put($format) {
		$plugin = new MenuPlugin($format);
		$plugin->render_plugin();	
	}
}

function plugin_Menu($format) {
	MenuPlugin::put($format);
}

?>
