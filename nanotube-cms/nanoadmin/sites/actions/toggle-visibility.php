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
ActionTemplate::check_errors();

// load data object
$sites = Sites::get();
$site = $sites->get_site($id);
if (!$site) {
	Errors::add("Not found", "Site $id not found", false);
	ActionTemplate::check_errors();
}

// modify data object
$site->set_visible(! $site->is_visible());

// save changed
$sites->update_site($site->get_id(), $site);

ActionTemplate::check_errors();
ActionTemplate::success("../");

?>

