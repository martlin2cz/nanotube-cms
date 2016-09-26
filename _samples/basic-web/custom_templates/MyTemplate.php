<?php

require_once(__DIR__ . '/../../../nanotube-cms/templates/definite/NormalPageTemplate.php');
require_once(__DIR__ . '/../../../nanotube-cms/impl/Tools.php');

class MyTemplate extends NormalPageTemplate {

	public function __construct($config) {
		parent::__construct($config);
	}
	
	protected function get_title() {
		return $this->get_site()->get_title() . " | " . $this->get_config()->get_web_title();
	}

	protected function do_body($apc) { ?>
		<header>
			<h1><?= $this->get_config()->get_web_title() ?></h1>
		</header>

		<main>
			<article>
				<h2><?= $this->get_site()->get_title() ?></h2>
				<section>

					<?php $this->do_site_content($apc); ?>

				</section>
			</article>
		</main>
	
		<footer>
			<span>Hledáte něco jiného? Zkuste </span> <nav> <?php plugin_Menu('?id=$site-id'); ?> </nav>
		</footer>
	<?php }
}

?>
