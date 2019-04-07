<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/ActionTemplate.php');
require_once(__DIR__ . '/../../impl/WebTools.php');

require_once(__DIR__ . '/../../../impl/Tools.php');
require_once(__DIR__ . '/../../../impl/database/Configs.php');
require_once(__DIR__ . '/../../../impl/Errors.php');
require_once(__DIR__ . '/../../../impl/Passwording.php');

ActionTemplate::before_start("../../", true);

$configs = Configs::get();

// check params
WebTools::require_posted_id('web-title', false);
WebTools::require_posted_string('web-description', true);
WebTools::require_posted_string('web-keywords', true);
WebTools::require_posted_password('nanoadmin-password', true);
WebTools::require_posted_password('confirm-password', true);



ActionTemplate::check_errors();

// infer params
$web_title = $_POST['web-title'];
$web_description = $_POST['web-description'];
$web_keywords = $_POST['web-keywords'];
$nanoadmin_password = $_POST['nanoadmin-password'];
$password_confirm = $_POST['confirm-password'];


if ($nanoadmin_password != $password_confirm) {
	Errors::add("Passwords does not match", "Entered passwords did't match", false);
	ActionTemplate::check_errors();	
}

// load data object
$config = $configs->get_config();

// modify data object
$config->set_web_title($web_title);
$config->set_web_description($web_description);
$config->set_web_keywords($web_keywords);

// even the password
$passwording = new Passwording();
$hash = $passwording->generate_password_hash($nanoadmin_password);
$config->set_na_password($hash[0]);		
$config->set_na_password_salt($hash[1]);		



// save changed
$succ = $configs->save_config($config);

ActionTemplate::check_errors();
if ($succ) {
	ActionTemplate::success("../");
}
?>

