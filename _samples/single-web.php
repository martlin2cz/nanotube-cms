<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include required files
require_once(__DIR__ . '/../nanotube-cms/templates/PageTemplater.php');
require_once(__DIR__ . '/../nanotube-cms/templates/head_templates/SingleBaseHeadTemplate.php');
require_once(__DIR__ . '/../nanotube-cms/templates/body_templates/SingleBaseBodyTemplate.php');

//initalize web configuration
$config = new Config("Můj web");

//setup html head and body templates
$head_template = new SingleBaseHeadTemplate($config);
$body_template = new SingleBaseBodyTemplate($config);

//create templater
$templater = new PageTemplater($config, $head_template, $body_template);

//and finaly render!
$templater->render_template();
?>
