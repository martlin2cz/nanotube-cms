<?php 

require_once(__DIR__ . '/../AbstractHeadTemplate.php');

class BaseHeadTemplate implements AbstractHeadTemplate {
	private $config;
	private $title;

	public function __construct($config, $title) {
		$this->config = $config;
		$this->title = $title;
	}

	public function prepare_head($apc) {
		//nothing
	}

	public function render_head($apc) { ?>
		<!-- basic heads: -->
		<meta charset="UTF-8">
		<title><?= $this->title ?> <?= $apc->get_title_suffix() ?></title>	
		<!-- TODO: meta tags here-->
		<!-- additional heads: -->
		<?php foreach ($apc->get_heads() as $head) { ?>
			<?= $head ?>
		<?php } ?>
	<?php }

}
