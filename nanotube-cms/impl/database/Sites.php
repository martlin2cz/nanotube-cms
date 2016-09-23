<?php

require_once('Site.php');

class Sites {
	private $sites;

	public function __construct() {
	
		$this->sites = Array(
			'welcome' => new Site('welcome', "Vítejte", "Ahoj, vítejte tu!"),
			'about-us' => new Site('about-us', "O nás", "Jsme Lorem Ipsum")
		);
	}

	public function all_sites() {
		return $this->sites;
	}
	
	public function index_site() {
		return $this->sites['welcome'];
	}

	public function get_site($site_id) {
		return $this->sites[$site_id];
	}

	public function error_404_site() {
		return new Site('404', "Not found", "Not found");
	}

	public function __toString() {
		return "Sites: " . count($this->sites);
	}
}



?>
