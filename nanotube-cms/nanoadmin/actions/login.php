<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/LogingIn.php');
require_once(__DIR__ . '/../../impl/Tools.php');

//TODO check password !!!!
LogingIn::get()->log_in();

Tools::redirect_to_relative('../');

?>
