<?php

require_once(__DIR__ . '/../../../nanotube-cms/templates/definite/SinglePageTemplate.php');

class MyTemplate extends SinglePageTemplate {

	public function __construct($config) {
		parent::__construct($config);
	}
	
	protected function get_title() {
		return $this->get_config()->get_web_title();
	}

	protected function do_body($apc) { ?>
		<header>
			<h1><?= $this->get_config()->get_web_title() ?></h1>
			<nav>
				<?php plugin_Menu('#$site-id'); ?>
			</nav>
		</header>

		<main>
			<?php foreach ($this->get_sites() as $site) { ?>
			<article id="<?= $site->get_id() ?>">
				<h2><?= $site->get_title() ?></h2>
				<section>

					<?php $this->do_site_content($apc, $site); ?>

				</section>
			</article>
			<?php } ?>
		</main>
	
		<footer>
			Toť vše.
		</footer>
	<?php }
}

?>
