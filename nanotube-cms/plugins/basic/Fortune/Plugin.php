<?php

require_once(__DIR__ . '/../../AbstractPlugin.php');
require_once(__DIR__ . '/database/Quotes.php');

class FortunePlugin extends AbstractPlugin {
	private $quotes;

	public function __construct($config) {
		parent::__construct($config, __FILE__, 'Fortune');
		$this->quotes = new Quotes();
	}

	public function get_description() {
		return "Plugin displaying random quotes.";
	}

	public function get_usage() {
		return "<code><?php plugin_Fortune('id of dictionary')); ?></code>";	
	}

	public function get_status() {
		if ($this->quotes->is_ok()) {
			return PLUGIN_STATUS_INSTALLED;
		} else {
			return PLUGIN_STATUS_UNINSTALLED;
		}
	}

	public function install() {
		return $this->quotes->install();
	}
	
	public function uninstall() {
		return $this->quotes->uninstall();
	}
	public function render_plugin_content($apc, $config, $args) {
		$dictionary = $args[0];
		$quote = $this->quotes->get_random_quote($dictionary_id); 
		?><cite><?= $quote->get_text() ?>, <?= $quote->get_author() ?></cite>
	<?php }

	static public function put($dictionary_id) {
		$plugin = new FortunePlugin();
		$plugin->render_plugin($dictionary_id);	
	}
}

function plugin_Fortune($dictionary_id) {
	FortunePlugin::put($dictionary_id);
}

?>
