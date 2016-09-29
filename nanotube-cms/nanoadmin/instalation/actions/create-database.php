<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/WebTools.php');
require_once(__DIR__ . '/../../impl/ActionTemplate.php');

require_once(__DIR__ . '/../../../impl/Tools.php');
require_once(__DIR__ . '/../../../impl/database/Configs.php');
require_once(__DIR__ . '/../../../impl/database/Admins.php');
require_once(__DIR__ . '/../../../impl/database/Sites.php');
require_once(__DIR__ . '/../../../impl/Plugins.php');


ActionTemplate::before_start("../../", true);

//config
$admins = Admins::get();
$sites = Sites::get();
$plugins = new Plugins();

$admins_ok = $admins->install();
if (!$admins_ok) {
		Errors::add("Database error creation error", "Cannot initialize admins", true);
}

$sites_ok = $sites->install();
if (!$sites_ok) {
		Errors::add("Database error creation error", "Cannot initialize sites", true);
}

$plugins_ok = $plugins->install();
if (!$plugins_ok) {
		Errors::add("Plugins install error", "Cannot install plugins", true);
}

ActionTemplate::check_errors();
ActionTemplate::success("../");
?>

