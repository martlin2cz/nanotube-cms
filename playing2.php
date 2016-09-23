<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	require_once('nanotube-cms/templates/ExtendedStandartTemplate.php');

$templ = new ExtendedStandartTemplate(
	"Vítejte na našem webu", 
	function($site) {
		echo "Stránka " . $site->get_title() . " vytvořena pomocí nanotube-cms.";
	});
	$templ->render();

?>
