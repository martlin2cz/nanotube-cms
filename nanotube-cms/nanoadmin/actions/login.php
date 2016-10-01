<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/LogingIn.php');
require_once(__DIR__ . '/../../impl/Tools.php');

//TODO check password !!!!
$admin = new Admin("fooooo");	//TODO ooo FIXME eee 
LogingIn::get()->log_in($admin);

Tools::redirect_to_relative('../');

?>
