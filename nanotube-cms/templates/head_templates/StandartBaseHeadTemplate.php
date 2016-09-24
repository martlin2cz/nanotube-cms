<?php 

require_once(__DIR__ . '/BaseHeadTemplate.php');

class StandartBaseHeadTemplate extends BaseHeadTemplate {

	public function __construct($config, $site) {
		parent::__construct($config, $this->make_title($config, $site));
	}

	private function make_title($config, $site) {
		return $site->get_title() . " | " . $config->get_web_title();
	}

}
