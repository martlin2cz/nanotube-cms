<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include required files
require_once(__DIR__ . '/../../../templates/MyTemplate.php');

require_once(__DIR__ . '/database/Configs.php');
require_once(__DIR__ . '/Tools.php');

//initalize web configuration
$config = Configs::get()->get_config();

//setup html head and body templates
$template = new MyTemplate($config);

//and finaly render!
$template->render_template(null);
?>
