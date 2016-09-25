<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include required files
require_once(__DIR__ . '/../nanotube-cms/templates/PageTemplater.php');
require_once(__DIR__ . '/../nanotube-cms/templates/head_templates/SingleBaseHeadTemplate.php');
require_once(__DIR__ . '/../nanotube-cms/templates/body_templates/SingleFullBodyTemplate.php');
require_once(__DIR__ . '/../nanotube-cms/impl/Plugins.php');


//initalize web configuration
$config = new Config("Můj web");

//initialize plugins
$plugins = new Plugins();
$plugins->load_all_plugins();

//setup html head and body templates
$head_template = new SingleBaseHeadTemplate($config);
$body_template = new SingleFullBodyTemplate($config, 
	//header
	"<p><h2>" . $config->get_web_title() . "</h2></p>",
	//footer
	"<p><em>Created by <a href=\"https://github.com/martlin2cz/nanotube-cms\">nanotube-cms</a></em>.</p>"
);

//create templater
$templater = new PageTemplater($config, $head_template, $body_template);

//and finaly render!
$templater->render_template();
?>
