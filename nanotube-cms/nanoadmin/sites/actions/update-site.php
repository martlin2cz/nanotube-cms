<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/WebTools.php');
require_once(__DIR__ . '/../../impl/ActionTemplate.php');

require_once(__DIR__ . '/../../../impl/Tools.php');
require_once(__DIR__ . '/../../../impl/database/Sites.php');
require_once(__DIR__ . '/../../../impl/LogingIn.php');

ActionTemplate::before_start("../../", true);

// check params
$current_site_id = WebTools::require_posted_id('current-site-id', true);
$id = WebTools::require_posted_id('site-id', false);
$title = WebTools::require_posted_string('title', false);
$content = WebTools::require_posted_string('content', false);
$visible = WebTools::require_posted_bool('visible');

ActionTemplate::check_errors();

// infer params
$user = LogingIn::get()->logged_admin()->get_username();
$timestamp = time();

$is_update = ($current_site_id != '');
$sites = Sites::get();

// load/create data object
if ($is_update) {
	$site = $sites->get_site($current_site_id);
	if (!$site) {
		Errors::add("Not found", "Site $current_site_id not found", false);
	}
} else {
	$site = $sites->get_site($id);
	if ($site) {
		Errors::add("Yet exists", "Site $id yet exists", false);
	}

	$order_num = count($sites->all_sites()) + 1;
	$site = new Site(null, null, null, null, null, null, null, false, $order_num);
}

ActionTemplate::check_errors();

// modify data object
$site->set_id($id);
$site->set_title($title);
$site->set_content($content);

if (!$is_update) {
	$site->set_created_at($timestamp);
	$site->set_created_by($user);
}
$site->set_last_modified_at($timestamp);
$site->set_last_modified_by($user);
$site->set_visible($visible);
 
// save changed
if ($is_update) {
	$succ = $sites->update_site($current_site_id, $site);
} else {
	$succ = $sites->create_site($site);
}

if (!$succ) {
	Errors::add("Database error", "Cannot save data.", true);
}

ActionTemplate::check_errors();
ActionTemplate::success("../");

?>

