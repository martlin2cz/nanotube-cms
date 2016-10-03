<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content("../", "Plugin details", true, ""); ?>

<?php

require_once(__DIR__ . '/../impl/WebTools.php');
require_once(__DIR__ . '/../../impl/Plugins.php');

$plugins = Plugins::get();

$id = WebTools::require_getted_id('id', false);

$plugin = $plugins->get_plugin($id);
if (!$plugin) {
	Errors::add("Params error", "Plugin $id not found.");
}

NAtemplate::check_errors();
?>

	<h2>Plugin <?= $plugin->get_name() ?></h2>
	<section>
		<?= $plugin->get_description() ?>
	</section>

	<h2>Usage</h2>
	<section>
		<?= $plugin->get_usage() ?>
	</section>
<?php NAtemplate::after_content(); ?>
