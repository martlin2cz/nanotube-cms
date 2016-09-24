<?php 

require_once(__DIR__ . '/../AbstractBodyTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');
require_once(__DIR__ . '/../../impl/database/Sites.php');

class SingleBaseBodyTemplate implements AbstractBodyTemplate {
	private $config;
	private $string_content;
	private $sites;

	public function __construct($config) {
		$this->config = $config;
		$this->string_content = null;
		$this->sites = new Sites();
	}

	public function prepare_body($apc) {
		$php = "";
		foreach ($this->sites->all_sites() as $site) {	
			$php	.= "<h2>" . $site->get_title() . "</h2>\n"
						. "\n<article>\n"	
						. $site->get_content()
						. "\n</article>\n";
		}
		
		$this->string_content = Tools::run_php($php);
	}

	public function render_body($apc) {
		Tools::render_array($apc->get_before_content());
		Tools::render_string($this->string_content);
		Tools::render_array($apc->get_after_content());
	}
}
