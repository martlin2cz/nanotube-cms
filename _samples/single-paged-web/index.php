<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include required files
require_once(__DIR__ . '/custom_templates/MyTemplate.php');

require_once(__DIR__ . '/../../nanotube-cms/impl/dataobj/Config.php');
require_once(__DIR__ . '/../../nanotube-cms/impl/Tools.php');
require_once(__DIR__ . '/../../nanotube-cms/impl/Plugins.php');


//initalize web configuration
$config = new Config("Můj web");

//initialize plugins
$plugins = new Plugins();
$plugins->load_all_plugins();

//find current site
$site = Tools::current_site_by_url();

//setup html head and body templates
$template = new MyTemplate($config);

//and finaly render!
$template->render_template();
?>
