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
		parent::__construct();
		$this->config = $config;
		$this->site = Tools::current_site_by_url();
	}

	public function get_links_format() {
		return "?" . SITE_ID_GET_PARAM_NAME . "=" . LINKS_FORMAT_PATTERNER;
	}

	public function get_config() {
		return $this->config;
	}
	
	public function get_site() {
		return $this->site;
	}

	protected function do_head($apc) { ?>
		<title><?= $this->get_title() ?><?= $apc->get_title_suffix() ?></title>
		
		<?php if (!is_null($apc->get_resources_root())) { ?>
			<base href="<?= $apc->get_resources_root() ?>">
		<?php } ?>

		<meta charset="UTF-8">
		<meta name="description" content="<?= $this->config->get_web_description() ?>">
		<meta name="keywords" content="<?= $this->config->get_web_keywords() ?>">
		<meta name="generator" content="nanotube-cms">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<?= Tools::render_array($apc->get_pre_heads()) ?>

		<link rel="stylesheet" href="css/styles.css" type="text/css" />
		<script type="text/javascript" src="js/scripts.js"></script>

		<?= Tools::render_array($apc->get_post_heads()) ?>

		<?php $this->add_specific_headers() ?>
	<?php }

	protected function do_site_content($apc) {
		Tools::run_html_with_php($apc, $this->site->get_content());
	}

	protected abstract function add_specific_headers();


 	public function render_site($site, $resources_root) {
		$this->site = $site;
		$this->render_template($resources_root);
	}

}

?>
