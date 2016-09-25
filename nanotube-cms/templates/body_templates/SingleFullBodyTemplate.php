<?php 

require_once(__DIR__ . '/SingleBaseBodyTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');
require_once(__DIR__ . '/../../impl/database/Sites.php');

class SingleFullBodyTemplate extends SingleBaseBodyTemplate {

	private $header;
	private $footer;

	public function __construct($config, $header, $footer) {
		parent::__construct($config);
		$this->header = $header;
		$this->footer = $footer;
	}

  public function run_body_content($apc) { ?>
		<header>
			<?php if ($this->header) { ?>
				<?= $this->header ?>
			<?php } else { ?>
				<h1><?= $this->get_config()->get_web_title() ?></h1>
			<?php } ?>
			
			<nav>
				<?= plugin_Menu('#$site-id') ?>
			</nav>
		</header>

		<main>	
			<?php foreach ($this->get_sites()->all_sites() as $site) { ?>	
				<section>
					<h2><?= $site->get_title() ?></h2>

					<article>
						<?php Tools::run_html_with_php($apc, $site->get_content()); ?>
					</article>

				</section>
			<?php } ?>
		</main>

		<?php if ($this->footer) { ?>
      <footer>
        <?= $this->footer ?>
      </foooter>
		<?php } ?>
	<?php }
}
