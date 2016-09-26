<?php

require_once(__DIR__ . '/../base/PreRenderingPageTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');

/**
 * An base class for typical web. Each site has its own page (possible with common header, footer, sidebar, menu ...)
 * */
abstract class NormalPageTemplate extends PreRenderingPageTemplate {
	
	private $config;
	private $site;

	public function __construct($config) {
		$this->config = $config;
		$this->site = Tools::current_site_by_url();
	}

	public function get_config() {
		return $this->config;
	}
	
	public function get_site() {
		return $this->site;
	}

	protected function do_head($apc) { ?>
		<title><?= $this->get_title() ?><?= $apc->get_title_suffix() ?></title>
		<!--TODO meta tags, styles, ... -->		
		<link rel="stylesheet" href="css/styles.css" type="text/css" />
		<script type="text/javascript" src="js/scripts.js"></script>
	<?php }

	protected function do_site_content($apc) {
		Tools::run_html_with_php($apc, $this->site->get_content());		
	}

}

?>
