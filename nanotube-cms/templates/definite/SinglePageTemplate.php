<?php

require_once(__DIR__ . '/../base/PreRenderingPageTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');
require_once(__DIR__ . '/../../impl/database/Sites.php');

/**
 * An template ready for single paged webs. Provides list of all pages, so web's child template can easily iterate over.
 * */
abstract class SinglePageTemplate extends PreRenderingPageTemplate {
	
	private $config;
	private $sites;

	public function __construct($config) {
		$this->config = $config;
		$this->sites = new Sites();
	}

	public function get_config() {
		return $this->config;
	}
	
	public function get_sites() {
		return $this->sites->all_sites();
	}

	protected function do_head($apc) { ?>
		<title><?= $this->get_title() ?><?= $apc->get_title_suffix() ?></title>
		<!--TODO meta tags, styles, ... -->		
		<link rel="stylesheet" href="css/styles.css" type="text/css" />
		<script type="text/javascript" src="js/scripts.js"></script>
	<?php }

	protected function do_site_content($apc, $site) {
		Tools::run_html_with_php($apc, $site->get_content());		
	}

}

?>
