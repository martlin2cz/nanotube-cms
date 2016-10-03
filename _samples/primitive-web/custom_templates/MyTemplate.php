<?php

require_once(__DIR__ . '/../../../nanotube-cms/templates/definite/NormalPageTemplate.php');

/**
 * Template extending just the base template (with no header, menu, ...)
 * */
class MyTemplate extends NormalPageTemplate {

	public function __construct($config) {
		parent::__construct($config);
	}
	
	protected function get_title() {
		return $this->get_site()->get_title();
	}

  protected function add_specific_headers() {
		//nothing
	}

	protected function do_body($apc) { ?>
		<article>
			<?= $this->do_site_content($apc) ?>	
		</article>
	<?php }

}

?>
