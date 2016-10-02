<?php

require_once(__DIR__. '/../dataobj/Site.php');
require_once(__DIR__. '/Admins.php');
require_once(__DIR__. '/MysqlDatabase.php');

define("SITES_TABLE_NAME", "nt_sites");

class Sites {
	static private $instance;

	private $sites;

	static public function _static_init() {
		self::$instance = new Sites();
	}

	static public function get() {
		return self::$instance;
	}

	public function __construct() {
		$this->sites = $this->load_all_sites();
	}

	public function all_sites() {
		$sites = $this->all_sites_real();
		if (!$sites) {
			$sites = Array($this->db_failed_site());
		}
		return $sites;
	}

	public function all_sites_real() {
		return $this->sites;
	}
	
	public function index_site() {
		$sites = $this->all_sites();
		return reset($sites);
	}

	public function get_site($site_id) {
		$sites = $this->all_sites();
		if (isset($sites[$site_id])) {
			return $sites[$site_id];
		} else {
			return null;
		}
	}

	public function get_site_with_order($order_num) {
		foreach ($this->all_sites() as $site) {
			if ($site->get_order_num() == $order_num) {
				return $site;
			}
		}
		return null;
	}

	public function error_404_site() {
		return new Site('404', "Not found", "<p>Requested site not found.</p>", NANOADMIN_USERNAME, 0, NANOADMIN_USERNAME, 0, true, 1);
	}

	private function db_failed_site() {
		return new Site('database-failed', "Database failed", "<p>Failed to load contents.</p>", NANOADMIN_USERNAME, 0, NANOADMIN_USERNAME, 0, true, 1);
	}

	private function load_all_sites() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);
		
		$array = $db->select(SITES_TABLE_NAME, "*", null, "order_num");
		if (!$array) {
			return null;
		}
		$result = Array();
		foreach ($array as $item) {
			$site = new Site(
				$item['id'],
				$item['title'],
				$item['content'],
				$item['created_by'], 
				strtotime($item['created_at']),
				$item['last_modified_by'], 
				strtotime($item['last_modified_at']),
				$item['visible'], 
				$item['order_num']);
			$result[$site->get_id()] = $site;
		}	
		return $result;
	}

	public function update_site($current_id, $site) {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);
		
		return $db->update(SITES_TABLE_NAME, ""
			. "id='" . $site->get_id() . "', "
			. "title='" . $db->escape_string($site->get_title()) . "', "
			. "content='" . $db->escape_string($site->get_content()) . "', "
			. "created_by='" . $site->get_created_by() . "', "
			. "created_at='" . date(MYSQL_DATE_FORMAT, $site->get_created_at()) . "', "
			. "last_modified_by='" . $site->get_last_modified_by() . "', "
			. "last_modified_at='" . date(MYSQL_DATE_FORMAT, $site->get_last_modified_at()) . "', "
			. "visible=" . $db->bool_to_sql($site->is_visible()) . ", "
			. "order_num=" . $site->get_order_num(),
			"id = '$current_id'");
	}
	
	public function create_site($site) {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);
		
		return $db->insert(SITES_TABLE_NAME,
			"(id, title, content, created_by, created_at, last_modified_by, last_modified_at, visible, order_num)",
			"("
			. "'". $site->get_id() . "', "
			. "'". $db->escape_string($site->get_title()) . "', "
			. "'". $db->escape_string($site->get_content()) . "', "
			. "'". $site->get_created_by() . "', "
			. "'". date(MYSQL_DATE_FORMAT, $site->get_created_at()) . "', "
			. "'". $site->get_last_modified_by() . "', "
			. "'". date(MYSQL_DATE_FORMAT, $site->get_last_modified_at()) . "', "
			. $db->bool_to_sql($site->is_visible()) . ", "
			. $site->get_order_num()
			. ")");
	}

	public function install() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		$created = $db->create_table(SITES_TABLE_NAME, "(" 
			. "id CHAR(50) NOT NULL, "
			. "title CHAR(100) NOT NULL, "
			. "content TEXT NOT NULL, "
			. "created_by CHAR(50) NOT NULL, "
			. "created_at DATETIME NOT NULL, "
			. "last_modified_by CHAR(50) NOT NULL, "
			. "last_modified_at DATETIME NOT NULL, "
			. "visible BOOLEAN NOT NULL, "
			. "order_num SMALLINT NOT NULL, "
			. "PRIMARY KEY (id), "
			. "FOREIGN KEY (created_by) REFERENCES " . ADMINS_TABLE_NAME . "(username), "
			. "FOREIGN KEY (last_modified_by) REFERENCES " . ADMINS_TABLE_NAME . "(username)"
			. ")");
		$inserted = $this->create_site(new Site("welcome", "Welcome!", "<p><em>nanoadmin</em> seems working!</p>", 
			NANOADMIN_USERNAME, time(), NANOADMIN_USERNAME, time(), true, 1));
		return $created && $inserted;
	}

	public function __toString() {
		return "Sites: " . count($this->sites);
	}
}

Sites::_static_init();

?>
