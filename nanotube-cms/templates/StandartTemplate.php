<?php
require_once(__DIR__ . '/BaseTemplate.php');
require_once(__DIR__ . '/../impl/database/Sites.php');

define("SITE_ID_GET_PARAM_NAME", "id");

class StandartTemplate extends BaseTemplate {

	protected $site;

	public function __construct() {
		$this->site = $this->find_site();
	}

	private function find_site() {
		$sites = new Sites();

		if (!isset($_GET) || !isset($_GET[SITE_ID_GET_PARAM_NAME])) {
			return $sites->index_site();	
		}

		$site_id = $_GET[SITE_ID_GET_PARAM_NAME];
		$site = $sites->get_site($site_id);

		if ($site) {
			return $site;
		} else {
			return $sites->error_404_site();
		}
	}

	public function render_title() {
		echo $this->site->get_title();
	}

	public function render_content() {
		echo $this->site->get_content();
	}

	public function render_body() {
		$this->render_content();
	}
 
}

?>


