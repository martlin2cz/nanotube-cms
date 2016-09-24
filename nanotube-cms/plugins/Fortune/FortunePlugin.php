<?php

require_once(__DIR__ . '/../AbstractPlugin.php');
require_once(__DIR__ . '/Quotes.php');


class FortunePlugin extends AbstractPlugin {
	private $quotes;

	public function __construct() {
		parent::__construct('Fortune');
		$this->quotes = new Quotes();
	}

	public function get_description() {
		return "Plugin displaying random quotes.";
	}

	public function get_usage() {
		return "<code><?php plugin_Fortune()); ?></code>";	
	}

	public function render_plugin_content($apc) { ?>
		<?php $quote = $this->quotes->get_random_quote(); ?>		
		<cite><?= $quote->get_text() ?>, <?= $quote->get_author() ?></cite>
	<?php }

	static public function put() {
		$plugin = new FortunePlugin();
		$plugin->render_plugin();	
	}
}

function plugin_Fortune() {
	FortunePlugin::put();
}

?>
