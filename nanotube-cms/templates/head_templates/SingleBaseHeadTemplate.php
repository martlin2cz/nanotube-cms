<?php 

require_once(__DIR__ . '/BaseHeadTemplate.php');

class SingleBaseHeadTemplate extends BaseHeadTemplate {

	public function __construct($config) {
		parent::__construct($config, $config->get_web_title());
	}

}
