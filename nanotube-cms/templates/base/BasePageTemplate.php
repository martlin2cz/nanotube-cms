<?php

require_once(__DIR__ . '/AbstractPageTemplate.php');
require_once(__DIR__ . '/../../impl/dataobj/AditionalPageConfig.php');


/**
 * Represents base page template. This template copounds from html head and body sections. Specifies methods to render them.
 * */
abstract class BasePageTemplate implements AbstractPageTemplate {


	public function __construct() {
	}

	abstract public function get_links_format();
	
	public function render_template() {
		$apc = new AditionalPageConfig();

		$this->prepare_them($apc);
		$this->render_them($apc);
	}

	/**
	 * Prepares head and body section to be rendered.
	 * */
	protected function prepare_them($apc) {
		$this->prepare_head($apc);
		$this->prepare_body($apc);
	}

	/**
	 * Renders head and body into html page.
	 * */
	protected function render_them($apc) { ?><!DOCTYPE html>
		<html>
			<head>
				<?php $this->put_head_content($apc); ?>
			</head>
			<body>
				<?php $this->put_body_content($apc); ?>
			</body>
		</html>
	<?php }

	/**
	 * Prepares head to be rendered.
	 * */
	public abstract function prepare_head($apc);

	/**
	 * Prepares body to be rendered.
	 * */
	public abstract function prepare_body($apc);

	/**
	 * Puts the head element content.
	 * */
	public abstract function put_head_content($apc);

	/**
	 * Puts the body element content.
	 * */
	public abstract function put_body_content($apc);
}

?>
