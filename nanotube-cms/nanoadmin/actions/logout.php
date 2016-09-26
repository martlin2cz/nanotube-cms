<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/LogingIn.php');
require_once(__DIR__ . '/../../impl/Tools.php');

LogingIn::get()->log_out();

Tools::redirect_to_relative('../');

?>
