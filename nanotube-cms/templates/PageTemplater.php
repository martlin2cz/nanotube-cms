<?php

require_once(__DIR__ . '/../impl/dataobj/Config.php');
require_once(__DIR__ . '/../impl/dataobj/AditionalPageConfig.php');

require_once(__DIR__ . '/AbstractHeadTemplate.php');
require_once(__DIR__ . '/AbstractBodyTemplate.php');

class PageTemplater {

	protected $config;
	protected $head_template;
	protected $body_template;

	public function __construct($config, $head_template, $body_template) {
		$this->config = $config;
		$this->head_template = $head_template;
		$this->body_template = $body_template;
	}

	public function render_template() {
		$apc = new AditionalPageConfig();
		$this->prepare($apc);
		$this->render_html($apc);	
	}	

	public function prepare($apc) {
		$this->body_template->prepare_body($apc);
		$this->head_template->prepare_head($apc);
	}
	
	public function render_html($apc) { ?><!DOCTYPE>
		<html>
			<head>
				<?php $this->head_template->render_head($apc); ?>
			</head>
			<body>
				<?php $this->body_template->render_body($apc); ?>
			</body>
		</html>
	<?php }
}
?>
