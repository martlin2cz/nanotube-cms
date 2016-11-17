<?php

require_once(__DIR__ . '/../base/PreRenderingPageTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');
require_once(__DIR__ . '/../../impl/database/Sites.php');

/**
 * An template ready for single paged webs. Provides list of all pages, so web's child template can easily iterate over.
 * */
abstract class SinglePageTemplate extends PreRenderingPageTemplate {
	
	private $config;
	private $sites_spec;

	public function __construct($config) {
		parent::__construct();
		$this->config = $config;
		$this->sites_spec = Sites::get();
	}

	public function get_links_format() {
		return "#" . LINKS_FORMAT_PATTERNER;
	}

	public function get_config() {
		return $this->config;
	}
	
	public function get_sites() {
		if (get_class($this->sites_spec) == 'Sites') {
			return $this->sites_spec->all_sites();
		} else if (get_class($this->sites_spec) == 'Site') {
			return Array($this->sites_spec);
		} else {
			return null;
		}
	}

	protected function do_head($apc) { ?>
		<title><?= $this->get_title() ?><?= $apc->get_title_suffix() ?></title>
		<!--TODO meta tags, styles, ... -->		
    <?php if (!is_null($apc->get_resources_root())) { ?>                                                                               
      <base href="<?= $apc->get_resources_root() ?>" >
    <?php } ?>

		<?php Tools::render_array($apc->get_pre_heads()) ?>
	
		<link rel="stylesheet" href="css/styles.css" type="text/css" />
		<script type="text/javascript" src="js/scripts.js"></script>
		
		<?php Tools::render_array($apc->get_post_heads()); ?>
	<?php }

	protected function do_site_content($apc, $site) {
		Tools::run_html_with_php($apc, $site->get_content());		
	}

	public function render_site($site, $resources_root) {
		$this->sites_spec = $site;
		$this->render_template($resources_root);	
	}
}

?>
