<?php
require_once(__DIR__ . '/StandartTemplate.php');

class ExtendedStandartTemplate extends StandartTemplate {
	private $header;
	private $footer;

	public function __construct($config, $header, $footer) {
		parent::__construct($config);

		$this->header = $header;
		$this->footer = $footer;
	}

	public function render_body() { ?>
		<header>
			<?php $this->render_item($this->header); ?>
		</header>
		<main>
			<h1><?= $this->site->get_title(); ?></h1>
			<article>
				<?php	$this->render_content(); ?>
			</article>
		</main>
		<footer>
			<?php $this->render_item($this->footer); ?>
		</footer>
	<?php }

	private function render_item($item) {
		if (is_callable($item)) {
			$item($this->site);
		} else {
			echo $item;
		}
	}
}

?>
