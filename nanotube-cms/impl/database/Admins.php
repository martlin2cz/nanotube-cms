<?php
require_once(__DIR__. '/../dataobj/Admin.php');
require_once(__DIR__. '/Configs.php');
require_once(__DIR__. '/MysqlDatabase.php');

define("ADMINS_TABLE_NAME", "nt_admins");
define("NANOADMIN_USERNAME", "nanoadmin");


class Admins {
	static private $instance;

	private $admins;

	static public function _static_init() {
		self::$instance = new Admins();
	}

	static public function get() {
		return self::$instance;
	}


	public function __construct() {
		$this->admins = $this->load_all_admins();
	}
	
	public function all_admins() {
		$admins = $this->all_admins_real();
		if (!$admins) {
			$nanoadmin = $this->get_nanoadmin();
			$admins = Array($nanoadmin->get_username() => $nanoadmin);
		}
		return $admins;
	}
	

	public function all_admins_real() {
		return $this->admins;
	}
	
	public function get_admin($username) {
		$admins = $this->all_admins();
		if (isset($admins[$username])) {
			return $admins[$username];
		} else {
			return null;
		}
	}

	public function get_nanoadmin() {
		$config = Configs::get()->get_config();
		return new Admin(NANOADMIN_USERNAME, "Nano Admin", $config->get_na_password(), $config->get_na_password_salt(), true, 0, time());
	}

  private function load_all_admins() {
    $config = Configs::get()->get_config();
    $db = new MysqlDatabase($config);

    $array = $db->select(ADMINS_TABLE_NAME, "*", null, null);
    if (!$array) {
      return null;
    }
    $result = Array();
    foreach ($array as $item) {
      $admin = new Admin(
        $item['username'],
        $item['full_name'],
        $item['password'],
        $item['password_salt'],
        $item['enabled'],
				strtotime($item['registered_at']),
				strtotime($item['last_login_at'])
			);
      $result[$admin->get_username()] = $admin;
    } 
    return $result;
  }

	public function update_admin($username, $admin) {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);
		
		return $db->update(ADMINS_TABLE_NAME, ""
			. "username='" . $admin->get_username() . "', "
			. "full_name='" . $db->escape_string($admin->get_full_name()) . "', "
			. "password='" . $admin->get_password() . "', "
			. "password_salt='" . $admin->get_password_salt() . "', "
			. "enabled=" . $db->bool_to_sql($admin->is_enabled()) . ", "
			. "registered_at='" . date(MYSQL_DATE_FORMAT, $admin->get_registered_at()) . "', "
			. "last_login_at='" . date(MYSQL_DATE_FORMAT, $admin->get_last_login_at()) . "'",
			"username = '$username'");
	}
	
	public function create_admin($admin) {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);
		
		return $db->insert(ADMINS_TABLE_NAME,
			"(username, full_name, password, password_salt, enabled, registered_at, last_login_at)",
			"("
			. "'". $admin->get_username() . "', "
			. "'". $db->escape_string($admin->get_full_name()) . "', "
			. "'". $admin->get_password() . "', "
			. "'". $admin->get_password_salt() . "', "
			. $db->bool_to_sql($admin->is_enabled()) . ", "
			. "'" . date( MYSQL_DATE_FORMAT, $admin->get_registered_at()) . "', "
			. "'" . date( MYSQL_DATE_FORMAT, $admin->get_last_login_at()) . "'"
			. ")");
	}

	public function install() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		$created = $db->create_table(ADMINS_TABLE_NAME, "(" 
			. "username CHAR(50) NOT NULL, "
			. "full_name CHAR(100) NOT NULL, "
			. "password CHAR(50) NOT NULL, "
			. "password_salt CHAR(100) NOT NULL, "
			. "enabled BOOLEAN NOT NULL, "
			. "registered_at DATETIME NOT NULL, "
			. "last_login_at DATETIME NOT NULL, "
			. "PRIMARY KEY (username), "
			. "KEY (username)"
			. ")");
		$inserted = $this->create_admin(new Admin(NANOADMIN_USERNAME, "Admin Nano", "pass", "salt", true, time(), time()));
		return $created && $inserted;
	}


	public function __toString() {
		return "Admins: " . count($this->admins);
	}
}

Admins::_static_init();



?>
