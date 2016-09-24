<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../nanotube-cms/templates/ExtendedStandartTemplate.php');



$config = new Config("Můj web");


$template = new ExtendedStandartTemplate(
	//configuration
	$config,

	//header
	"Vítejte na <strong>našem webu</strong>", 

	//footer
	function($site) {
		echo "Stránka " . $site->get_title() . " vytvořena pomocí nanotube-cms.";
	}
);

//render the template
$template->render();

?>
