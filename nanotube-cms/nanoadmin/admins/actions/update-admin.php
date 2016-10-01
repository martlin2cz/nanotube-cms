<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/WebTools.php');
require_once(__DIR__ . '/../../impl/ActionTemplate.php');

require_once(__DIR__ . '/../../../impl/database/Admins.php');
require_once(__DIR__ . '/../../../impl/Passwording.php');

ActionTemplate::before_start("../../", true);

// check params
$current_username = WebTools::require_posted_id('current-username', true);
$username = WebTools::require_posted_id('username', false);
$full_name = WebTools::require_posted_string('full-name', false);
$enabled = WebTools::require_posted_bool('enabled', false);
$password = WebTools::require_posted_password('password', true);
$password_confirm = WebTools::require_posted_password('password-confirm', true);

ActionTemplate::check_errors();

$is_update = ($current_username != '');
$admins = Admins::get();

// load/create data object
if ($is_update) {
	$admin = $admins->get_admin($current_username);
	if (!$admin) {
		Errors::add("Not found", "Admin $current_username not found", false);
		ActionTemplate::check_errors();
	}
} else {
	$timestamp = time();
	$admin = new Admin(null, null, null, null, false, 0, $timestamp);
}

// modify data object
$admin->set_username($username);
$admin->set_full_name($full_name);
$admin->set_enabled($enabled);

if ($password != '') {
	if ($password != $password_confirm) {
		Errors::add("Passwords error", "Passwords did not match", false);
		ActionTemplate::check_errors();
	}

	$passwording = new Passwording();
	$hashed = $passwording->generate_password_hash($password);

	$admin->set_password($hashed[0]);
	$admin->set_password_salt($hashed[1]);
}
 
// save changed
if ($is_update) {
	$succ = $admins->update_admin($current_username, $admin);
} else {
	$succ = $admins->create_admin($admin);
}

if (!$succ) {
	Errors::add("Database error", "Cannot save data.", true);
}

ActionTemplate::check_errors();
ActionTemplate::success("../");

?>

