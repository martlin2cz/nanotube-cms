<?php require_once(__DIR__ . '/../impl/ActionTemplate.php'); ?>
<?php ActionTemplate::before_start('../', false); ?>
<?php

require_once(__DIR__ . '/../../impl/database/Admins.php');
require_once(__DIR__ . '/../../impl/LogingIn.php');
require_once(__DIR__ . '/../impl/WebTools.php');

$username = WebTools::require_posted_id('username', false);
$password = WebTools::require_posted_string('password', false);

ActionTemplate::check_errors();

$logining = LogingIn::get();
$admin = $logining->check_credentials($username, $password);

if (!$admin) {
	Errors::add("Authorisation failed", "Username or password incorrect.", false);
}

ActionTemplate::check_errors();

$logining->log_in($admin);

ActionTemplate::check_errors();
ActionTemplate::success("../");
?>
