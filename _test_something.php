<?php 
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once(__DIR__ . '/nanotube-cms/impl/database/Configs.php');
require_once(__DIR__ . '/nanotube-cms/impl/Tools.php');


?>
Included?
<?php

	echo "||" . Tools::make_link("bar") . "||";



?>
