<?php

require_once(__DIR__. '/../dataobj/Site.php');

class Sites {
	static private $instance;

	private $sites;

	static public function _static_init() {
		self::$instance = new Sites();
	}

	static public function get() {
		return self::$instance;
	}

	public function __construct() {
	
		$this->sites = Array(
			'welcome' => new Site('welcome', "Vítejte", "Ahoj, vítejte tu!", 'na', time(), 'na', time(), true),

			'about-us' => new Site('about-us', "O nás", 
				"Jsme <strong>Lorem</strong>. Děláme <em>Ipsum</em>.", 
				'na', time(), 'na', time(), true),
			
			'with-error' => new Site('with-error', "Stránka s chybou", 
				"Toto je HTML, <?php echo 'Toto je PHP'; ?> a teď bude 1/0: <?php \$x = 1/0; ?>", 
				'na', time(), 'na', time(), true),
			
			'with-plugins' => new Site('with-plugins', "Stránka s pluginy", 
				"Plugin Hello World: <?php plugin_HelloWorld('Ahoj, světe!'); ?>. Hezké, ne? A menu? <?php plugin_Menu('?id=\$site-id'); ?> A co <?php plugin_Fortune(); ?>?",
				'na', time(), 'na', time(), true)

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

	public function update_site($current_id, $site) {
		echo "Updating site";
	}
	
	public function create_site($site) {
		echo "Creating site";
	}
	public function __toString() {
		return "Sites: " . count($this->sites);
	}
}

Sites::_static_init();

?>
