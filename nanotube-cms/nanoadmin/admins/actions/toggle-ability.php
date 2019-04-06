<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/WebTools.php');
require_once(__DIR__ . '/../../impl/ActionTemplate.php');

require_once(__DIR__ . '/../../../impl/database/Admins.php');

ActionTemplate::before_start("../../", true);

// check params
$username = WebTools::require_getted_id('username', false);
ActionTemplate::check_errors();

// load data object
$admins = Admins::get();
$admin = $admins->get_admin($username);
if (!$admin) {
	Errors::add("Not found", "Admin $username not found", false);
	ActionTemplate::check_errors();
}

// modify data object
$admin->set_enabled(! $admin->is_enabled());

// save changed
$succ = $admins->update_admin($admin->get_username(), $admin);

if (!$succ) {
	Errors::add("Database NanoError", "Operation could not be performed.", true);
}

ActionTemplate::check_errors();
ActionTemplate::success("../");

?>

