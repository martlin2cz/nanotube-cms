<?php 

require_once(__DIR__ . '/../AbstractHeadTemplate.php');

class BaseHeadTemplate implements BaseHeadTemplate {
	private $title;

	public function __construct($config, $title) {
		__
		$this->config = $config;
		$this->title = $title;
	}

	public function prepare_head($apc) {
		//nothing
	}


	protected function put_core_heads($apc) { ?>
		<!-- basic heads: -->
		<meta charset="UTF-8">
		<title><?= $this->title ?> <?= $apc->get_title_suffix() ?></title>	
		<!-- TODO: meta tags here-->
		<!-- somthing goes here, or not? -->
	<?php } 

	protected function put_aditional_heads($apc) { ?>	
		<!-- additional heads: -->
		<?php foreach ($apc->get_heads() as $head) { ?>
			<?= $head ?>
		<?php } ?>
	<?php }
}
