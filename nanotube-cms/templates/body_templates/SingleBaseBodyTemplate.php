<?php 

require_once(__DIR__ . '/PrematureRenderingBodyTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');
require_once(__DIR__ . '/../../impl/database/Sites.php');

class SingleBaseBodyTemplate extends PrematureRenderingBodyTemplate {

	private $sites;

	public function __construct($config) {
		parent::__construct($config);
		$this->sites = new Sites();
	}


	public function run_body_content($apc) { ?>

		<main>	
			<h1><?= $this->get_config()->get_web_title() ?></h1>
			<?php foreach ($this->sites->all_sites() as $site) { ?>	
				<article>
					<h2><?= $site->get_title() ?></h2>
				
					<?php Tools::run_html_with_php($site->get_content()); ?>

				</article>
			<?php } ?>

		</main>
	<?php }
}
