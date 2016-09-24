<?php 

require_once(__DIR__ . '/../AbstractBodyTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');
require_once(__DIR__ . '/../../impl/Plugins.php');



abstract class PrematureRenderingBodyTemplate implements AbstractBodyTemplate {
	private $config;
	private $string_content;

	public function __construct($config) {
		$this->config = $config;
		$this->string_content = null;
	}

	public function get_config() {
		return $this->config;
	}

	public function prepare_body($apc) {
		$this->premature_render_body($apc);
	}

	public function premature_render_body($apc) {
		Tools::start_capturing_output();
		Plugins::start_using_plugins($apc);

		$this->run_body_content($apc);

		Plugins::finish_plugins_using();
		$html = Tools::finish_capturing_output();
		$this->string_content = $html;
	}

	public abstract function run_body_content($apc);

	public function render_body($apc) {
		Tools::render_array($apc->get_before_content());
		Tools::render_string($this->string_content);
		Tools::render_array($apc->get_after_content());
	}

}
