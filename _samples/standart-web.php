<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include required files
require_once(__DIR__ . '/../nanotube-cms/impl/Tools.php');
require_once(__DIR__ . '/../nanotube-cms/templates/PageTemplater.php');
require_once(__DIR__ . '/../nanotube-cms/templates/head_templates/StandartBaseHeadTemplate.php');
require_once(__DIR__ . '/../nanotube-cms/templates/body_templates/StandartBaseBodyTemplate.php');

//initalize web configuration
$config = new Config("Můj web");

//find current site
$site = Tools::current_site_by_url();

//setup html head and body templates
$head_template = new StandartBaseHeadTemplate($config, $site);
$body_template = new StandartBaseBodyTemplate($config, $site);

//create templater
$templater = new PageTemplater($config, $head_template, $body_template);

//and finaly render!
$templater->render_template();
?>
