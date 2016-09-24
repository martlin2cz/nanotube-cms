<?php 

require_once(__DIR__ . '/PrematureRenderingBodyTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');

class StandartBaseBodyTemplate extends PrematureRenderingBodyTemplate {
	private $site;

	public function __construct($config, $site) {
		parent::__construct($config);
		$this->site = $site;
	}


	public function run_body_content($apc) { ?>
		<h1><?= $this->site->get_title() ?></h1>
		<article>
			<?php Tools::run_html_with_php($this->site->get_content()); ?>
		</article>
	<?php }

}
