<?php

require_once(__DIR__ . '/../base/PreRenderingPageTemplate.php');

abstract class BasicPageStructureTemplate extends PreRenderingPageTemplate {
	
	private $config;

	public function __construct($config) {
		$this->config = $config;
	}

	public function get_config() {
		return $this->config;
	}

	protected function do_head($apc) { ?>
		<title><?= $this->get_title() ?></title>
		<!--TODO meta tags, styles, ... -->		
	<?php }
	
	protected function do_body($apc) { ?>

		<header>

			<?php $this->do_header(); ?>

		</header>

		<main>

			<?php $this->do_main_content(); ?>

		</main>

		<footer>

			<?php $this->do_footer(); ?>

		</footer>

	<?php }

	protected abstract function get_title();

	protected abstract function do_header();

	protected abstract function do_main_content();
	
	protected abstract function do_footer();
}

?>
