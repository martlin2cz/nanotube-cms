<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/ActionTemplate.php');
require_once(__DIR__ . '/../../impl/WebTools.php');

require_once(__DIR__ . '/../../../impl/Tools.php');
require_once(__DIR__ . '/../../../impl/database/Configs.php');

ActionTemplate::before_start("../../", true);

$configs = Configs::get();

// check params
WebTools::require_posted_id('web-title', false);
WebTools::require_posted_string('web-description', true);
WebTools::require_posted_string('web-keywords', true);

ActionTemplate::check_errors();

// infer params
$web_title = $_POST['web-title'];
$web_description = $_POST['web-description'];
$web_keywords = $_POST['web-keywords'];


// load data object
$config = $configs->get_config();

// modify data object
$config->set_web_title($web_title);
$config->set_web_description($web_description);
$config->set_web_keywords($web_keywords);

// save changed
$configs->save_config($config);

ActionTemplate::check_errors();
ActionTemplate::success("../");
?>

