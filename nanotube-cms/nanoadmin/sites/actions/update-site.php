<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/WebTools.php');
require_once(__DIR__ . '/../../../impl/Tools.php');
require_once(__DIR__ . '/../../../impl/database/Sites.php');
require_once(__DIR__ . '/../../../impl/LogingIn.php');


// check params
WebTools::require_posted_id('current-site-id', true);
WebTools::require_posted_id('site-id', false);
WebTools::require_posted_string('title', false);
WebTools::require_posted_string('content', false);

// infer params
$current_site_id = $_POST['current-site-id'];
$id = $_POST['site-id'];
$title = $_POST['title'];
$content = $_POST['content'];
$user = LogingIn::get()->logged_user();	//TODO
$timestamp = time();	//TODO

$is_update = ($current_site_id != '');

// load/create data object
if ($is_update) {
	$sites = new Sites();
	$site = $sites->get_site($current_site_id);
} else {
	$site = new Site();
}

// modify data object
$site->set_id($id);
$site->set_title($title);
$site->set_content($content);

if ($is_update) {
	$site->set_last_modified_at($timestamp);
	$site->set_last_modified_by($user);
} else {
	$site->set_created_at($timestamp);
	$site->set_created_by($user);
}
 
// save changed
if ($is_update) {
	$sites->update_site($current_id, $site);
} else {
	$sites->create_site($site);
}

Tools::redirect_to_relative('../');

?>

