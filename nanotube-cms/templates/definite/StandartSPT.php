<?php

require_once(__DIR__ . '/SinglePageTemplate.php');

class StandartSPT extends SinglePageTemplate {

	public function __construct($config) {
		parent::__construct($config);
	}
	
	protected function get_title() {
		return $this->get_config()->get_web_title();
	}

	protected function do_body($apc) { ?>
		<header>
			<?php $this->do_header($this->get_config()->get_web_title(), $apc); ?>
			<?php $this->do_menu($apc); ?>
		</header>

		<main>
			<?php $this->do_before_sites($apc); ?>

			<?php foreach ($this->get_sites() as $site) { ?>
				<?php if ($site->is_visible()) { ?>	
					<article id="<?= $site->get_id() ?>">
						<?php $this->do_before_site($site->get_title(), $site, $apc); ?>
					
						<section>
							<?php $this->do_site($site, $apc); ?>
						</section>

					</article>
				<?php } ?>
			<?php } ?>
	
			<?php $this->do_after_sites($apc); ?>
		</main>
	
		<footer>
			<?php $this->do_footer($apc); ?>
		</footer>
	<?php }

	protected function do_header($web_title, $apc) { ?>
		<h2><?= $web_title ?></h2>
	<?php }

	protected function do_menu($apc) { ?>
		<nav>
			<?php plugin_Menu(); ?>
		</nav>
	<?php }

	protected function do_before_sites($apc) {
		//nothing
	}

	protected function do_before_site($site_title, $site, $apc) { ?>
		<h2><?= $site->get_title() ?></h2>
	<?php }

	protected function do_site($site, $apc) { ?>
		<?php $this->do_site_content($apc, $site); ?>
	<?php }
		
	protected function do_after_sites($apc) {
		//nothing
	}

	protected function do_footer($apc) { ?>
		Created by <em>nanotube-cms</em>.
	<?php }
}

?>
