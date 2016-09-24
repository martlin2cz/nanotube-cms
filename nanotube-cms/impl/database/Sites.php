<?php

require_once(__DIR__. '/../dataobj/Site.php');

class Sites {
	private $sites;

	public function __construct() {
	
		$this->sites = Array(
			'welcome' => new Site('welcome', "Vítejte", "Ahoj, vítejte tu!"),
			'about-us' => new Site('about-us', "O nás", "Jsme Lorem. Děláme Ipsum."),
			'with-error' => new Site('with-error', "Stránka s chybou", "Toto je HTML, <?php echo 'Toto je PHP'; ?> a teď bude 1/0: <?php \$x = 1/0; ?>")
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
