<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include required files
require_once(__DIR__ . '/../nanotube-cms/impl/Tools.php');
require_once(__DIR__ . '/../nanotube-cms/templates/PageTemplater.php');
require_once(__DIR__ . '/../nanotube-cms/templates/head_templates/StandartBaseHeadTemplate.php');
require_once(__DIR__ . '/../nanotube-cms/templates/body_templates/StandartFullBodyTemplate.php');
require_once(__DIR__ . '/../nanotube-cms/impl/Plugins.php');


//initalize web configuration
$config = new Config("Můj web");

//initialize plugins
$plugins = new Plugins();
$plugins->load_all_plugins();

//find current site
$site = Tools::current_site_by_url();

//setup html head and body templates
$head_template = new StandartBaseHeadTemplate($config, $site);
$body_template = new StandartFullBodyTemplate($config, $site,
	//header
	"<p><h2>" . $config->get_web_title() . "</h2></p>",
	//format of menu links
	'?id=$site-id',
	//foooter
	"<p><em>Created by <a href=\"https://github.com/martlin2cz/nanotube-cms\">nanotube-cms</a></em>.</p>"
);

//create templater
$templater = new PageTemplater($config, $head_template, $body_template);

//and finaly render!
$templater->render_template();
?>
