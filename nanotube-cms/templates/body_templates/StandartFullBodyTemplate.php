<?php 

require_once(__DIR__ . '/StandartBaseBodyTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');

class StandartFullBodyTemplate extends StandartBaseBodyTemplate {
	private $header;
	private $menu_format;
	private $footer;

	public function __construct($config, $site, $header, $menu_format, $footer) {
		parent::__construct($config, $site);
		$this->header = $header;
		$this->menu_format = $menu_format;
		$this->footer = $footer;
	}

	public function run_body_content($apc) { ?>
		<?php if ($this->header) { ?>	
			<header>
				<?= $this->header ?>
			</header>
		<?php } ?>

		<?php if ($this->menu_format) { ?>	
			<nav>
				<?= plugin_Menu($this->menu_format) ?>
			</nav>
		<?php } ?>

		<main>
			<h1><?= $this->get_site()->get_title() ?></h1>
			<article>
				<?php Tools::run_html_with_php($apc, $this->get_site()->get_content()); ?>
			</article>
		</main>

		<?php if ($this->footer) { ?>	
			<footer>
				<?= $this->footer ?>
			</footer>
		<?php } ?>
	<?php }

}
