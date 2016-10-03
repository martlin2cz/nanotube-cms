<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/ActionTemplate.php');
require_once(__DIR__ . '/../../impl/WebTools.php');

require_once(__DIR__ . '/../../../impl/Plugins.php');

ActionTemplate::before_start("../../", true);

// check params
$id = WebTools::require_getted_id('plugin-id', false);
ActionTemplate::check_errors();

// load data object
$plugins = Plugins::get();
$plugin  = $plugins->get_plugin($id);
if (!$plugin) {
	Errors::add("Not found", "Plugin $id not found", false);
}
ActionTemplate::check_errors();

$succ = $plugin->uninstall();
if (!$succ) {
	Errors::add("Uninstalation failed", "Uninstalation of plugin failed.", false);
}

ActionTemplate::check_errors();
ActionTemplate::success("../");

?>

