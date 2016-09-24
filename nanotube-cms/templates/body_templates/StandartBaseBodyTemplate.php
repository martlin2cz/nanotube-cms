<?php 

require_once(__DIR__ . '/../AbstractBodyTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');

class StandartBaseBodyTemplate implements AbstractBodyTemplate {
	private $config;
	private $site;
	private $string_content;

	public function __construct($config, $site) {
		$this->config = $config;
		$this->site = $site;
		$this->string_content = null;
	}

	public function prepare_body($apc) {
		$this->string_content = Tools::run_php($this->site->get_content());
	}

	public function render_body($apc) {
		Tools::render_array($apc->get_before_content());
		Tools::render_string($this->string_content);
		Tools::render_array($apc->get_after_content());
	}

}
