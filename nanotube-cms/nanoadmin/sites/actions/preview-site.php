<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/WebTools.php');
require_once(__DIR__ . '/../../impl/ActionTemplate.php');

require_once(__DIR__ . '/../../../impl/Tools.php');
require_once(__DIR__ . '/../../../impl/dataobj/Site.php');
require_once(__DIR__ . '/../../../impl/LogingIn.php');

ActionTemplate::before_start("../../", true);

// check params
$id = WebTools::require_posted_id('site-id', false);
$title = WebTools::require_posted_string('title', false);
$content = WebTools::require_posted_string('content', false);

ActionTemplate::check_errors();

// infer params
$user = LogingIn::get()->logged_admin()->get_username();
$timestamp = time();

ActionTemplate::check_errors();
$site = new Site(null, null, null, null, null, null, null, null, null);

// create data object
$site->set_id($id);
$site->set_title($title);
$site->set_content($content);

$site->set_created_at($timestamp);
$site->set_created_by($user);
$site->set_last_modified_at($timestamp);
$site->set_last_modified_by($user);
$site->set_visible(true);


// finally get and render the template

ActionTemplate::check_errors();

$template = Tools::get_template();
$template->render_site($site, "../../../../");

?>

