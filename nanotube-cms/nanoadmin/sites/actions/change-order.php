<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/WebTools.php');
require_once(__DIR__ . '/../../impl/ActionTemplate.php');

require_once(__DIR__ . '/../../../impl/database/Sites.php');

ActionTemplate::before_start("../../", true);

// check params
$id = WebTools::require_getted_id('site-id', false);
$dir = WebTools::require_getted_string('move', false);

ActionTemplate::check_errors();
if (!($dir == "up" || $dir == "down")) {
	Errors::add("Invalid param", "Site can be moved <em>up</em> or <em>down</em>.", false);
	ActionTemplate::check_errors();
}
$is_up = ($dir == "up");

// load both afficted data objects
$sites = Sites::get();
$site = $sites->get_site($id);
if (!$site) {
	Errors::add("Not found", "Site $id not found", false);
	ActionTemplate::check_errors();
}

//swap their order_nums
$twin_order = $site->get_order_num() + ($is_up ? -1 : +1);
$twin = $sites->get_site_with_order($twin_order);

if ($twin) {
	$tmp = $site->get_order_num();
	$site->set_order_num($twin->get_order_num());
	$twin->set_order_num($tmp);
}

// save changed
$sites->update_site($site->get_id(), $site);
if ($twin) {
	$sites->update_site($twin->get_id(), $twin);
}

ActionTemplate::check_errors();
ActionTemplate::success("../");

?>

