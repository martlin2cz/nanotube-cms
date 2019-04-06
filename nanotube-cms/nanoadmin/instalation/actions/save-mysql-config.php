<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/WebTools.php');
require_once(__DIR__ . '/../../impl/ActionTemplate.php');

require_once(__DIR__ . '/../../../impl/Tools.php');
require_once(__DIR__ . '/../../../impl/database/Configs.php');
require_once(__DIR__ . '/../../../impl/database/MysqlDatabase.php');

ActionTemplate::before_start("../../", true);

//config
$configs = Configs::get();
$config = $configs->get_config();

// check params
WebTools::require_posted_string('server', true);
WebTools::require_posted_string('name', true);
WebTools::require_posted_string('username', true);
WebTools::require_posted_string('password', true);

ActionTemplate::check_errors();

// infer params
$server = $_POST['server'];
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

// modify data object
$config->set_mysql_server($server);
$config->set_mysql_database($name);
$config->set_mysql_user($username);
$config->set_mysql_password($password);

// save changed
$configs->save_config($config);

ActionTemplate::check_errors();

//check database
$db = new MysqlDatabase($config);


$succ = $db->test();
if (!$succ) {
	Errors::add("Database error", "Cannot connect to database", true);
}

ActionTemplate::check_errors();
ActionTemplate::success("../");
?>

