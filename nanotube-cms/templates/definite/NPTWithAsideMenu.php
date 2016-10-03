<?php

require_once(__DIR__ . '/NormalPageTemplate.php');
require_once(__DIR__ . '/../../impl/Tools.php');

/**
 * Template with one-site-per-page layout and predefined (and predimplemented) methods for putting header, site header, footer, etc. Theese methods can be simply overriden to provide custom functionality. Also adds support of sidebar with menu.
 * */
class NPTWithAsideMenu extends NormalPageTemplate {

	public function __construct($config) {
		parent::__construct($config);
	}
	
	protected function get_title() {
		return $this->get_page_title($this->get_site()->get_title(), $this->get_config()->get_web_title());
	}

	protected function do_body($apc) { ?>
		<header>
			<?php $this->do_page_header($this->get_site()->get_title(), $this->get_config()->get_web_title(), $apc); ?>
		</header>

		<aside>
			<?php $this->do_before_menu($apc); ?>
			<?php $this->do_menu($apc); ?>
			<?php $this->do_after_menu($apc); ?>
		</aside>

		<main>
			<article>
				<?php $this->do_before_site($this->get_site()->get_title(), $this->get_site(), $apc); ?>

				<section>
					<?php $this->do_site($this->get_site(), $apc); ?>

				</section>
				<?php $this->do_after_site($this->get_site(), $apc); ?>
			</article>
		</main>
	
		<footer>
			<?php $this->do_page_footer($apc); ?>
		</footer>
<?php }



	protected function get_page_title($site_title, $web_title) {
		return $site_title . " | " . $web_title;
	}

	protected function add_specific_headers() {
		//nothing
	}

	protected function do_page_header($site_title, $web_title, $apc) { ?>
		<h1><?= $web_title ?></h1>
	<?php }

	protected function do_before_menu($apc) { ?>
		<h3>Menu</h3>
	<?php }

	protected function do_menu($apc) { ?>
		<nav>
			<?php plugin_Menu(); ?>
		</nav>
	<?php }

	protected function do_after_menu($apc) {
		//nothing
	}




	protected function do_before_site($site_title, $site, $apc) { ?>
		<h2><?= $site_title ?></h2>
	<?php }

	protected function do_site($site, $apc) { ?>
		<?= $this->do_site_content($apc); ?>
	<?php }
	
	protected function do_after_site($site, $apc) {
		//nothing 	
	}

	protected function do_page_footer($apc) { ?>
		Created by <em>nanotube-cms</em>.
	<?php }

}



?>
