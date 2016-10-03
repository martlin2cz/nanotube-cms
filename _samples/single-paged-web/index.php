<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include required files
require_once(__DIR__ . '/custom_templates/MyTemplate.php');

require_once(__DIR__ . '/../../nanotube-cms/impl/database/Configs.php');
require_once(__DIR__ . '/../../nanotube-cms/impl/Tools.php');


//initalize web configuration
$config = Configs::get()->get_config();
$config->set_links_format("#" . LINKS_FORMAT_PATTERNER);

//setup html head and body templates
$template = new MyTemplate($config);

//and finaly render!
$template->render_template();
?>
