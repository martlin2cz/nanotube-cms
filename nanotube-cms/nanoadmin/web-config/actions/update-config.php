<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/WebTools.php');
require_once(__DIR__ . '/../../impl/ActionTemplate.php');

require_once(__DIR__ . '/../../../impl/Tools.php');
require_once(__DIR__ . '/../../../impl/database/Configs.php');

ActionTemplate::before_start("../../", true);

// check params
$web_title = WebTools::require_posted_string('web-title', false);
$web_description = WebTools::require_posted_string('web-description', true);
$web_keywords = WebTools::require_posted_string('web-keywords', true);
$na_password = WebTools::require_posted_password('na-password', true);
$na_password_confirm = WebTools::require_posted_password('na-password-confirm', true);
$links_format = WebTools::require_posted_string('links-format', false);

ActionTemplate::check_errors();

// load/create data object
$configs = Configs::get();
$config = $configs->get_config();

// modify data object
$config->set_web_title($web_title);
$config->set_web_description($web_description);
$config->set_web_keywords($web_keywords);
$config->set_links_format($links_format);

if ($na_password != '') {
	if ($na_password != $na_password_confirm) {
		Errors::add("Params error", "Passwords do not match", false);
	} else {
		$passwording = new Passwording();
		$hash = $passwording->generate_password_hash($na_password);
		
		$config->set_na_password($hash[0]);
		$config->set_na_password_salt($hash[1]);
	}
}


// save changed
$succ = $configs->save_config($config);

if (!$succ) {
	Errors::add("Database error", "Cannot save data.", true);
}

ActionTemplate::check_errors();
//ActionTemplate::success("../");

?>

