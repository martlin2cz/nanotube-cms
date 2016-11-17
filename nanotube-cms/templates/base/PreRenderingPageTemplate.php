<?php

require_once(__DIR__ . '/BasePageTemplate.php');
require_once(__DIR__ . '/../../impl/Plugins.php');


/**
 * Base template which firstly renders body into string (and according to that modifies head section) and finally then renders head - and directly outputs the rendered body.
 * */
abstract class PreRenderingPageTemplate extends BasePageTemplate {

	private $rendered_body;

	public function __construct() {
		parent::__construct();
	}

	public function prepare_head($apc) {
		//nothing
	}
	
	public function prepare_body($apc) {
		$this->rendered_body = $this->do_body_into_string($apc);
	}
	
	public function put_head_content($apc) {
		$this->do_head($apc);
	}

	public function put_body_content($apc) {
		Tools::render_string($this->rendered_body);
	}

	/**
	 * Renders body into returned string.
	 * */
	protected function do_body_into_string($apc) {
		Tools::start_capturing_output();
		Plugins::start_using_plugins($apc);

		$this->do_body($apc);

		Plugins::finish_using_plugins();
		return Tools::finish_capturing_output();
	}

	/**
	 * Renders head to output.
	 * */
	protected abstract function do_head($apc);

	/**
	 * Renders body to output.
	 * */
	protected abstract function do_body($apc);

}

?>
