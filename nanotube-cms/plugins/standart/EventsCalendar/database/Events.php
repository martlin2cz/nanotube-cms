<?php

require_once(__DIR__. '/../dataobj/Event.php');
require_once(__DIR__. '/../../../../impl/database/MysqlDatabase.php');
require_once(__DIR__. '/../../../../impl/database/Admins.php');


define("EVENTS_TABLE_NAME", "ntp_events");

class Events {
	private $events;


	public function __construct() {
		$this->events = $this->load_events();
	}

	public function all_events($only_future) {
		if (is_null($this->events)) {
			return Array();
		}

		if ($only_future) {
			return $this->filter_future($this->events);
		} else {
			return $this->events;
		}
	}

	private function filter_future($events) {
		$now = time();
		$result = Array();

		foreach ($events as $event) {
			if ($event->get_date() >= $now) {
				$result[] = $event;
			}
		}

		return $result;	
	}

	public function get_event($id) {
		foreach ($this->events as $event) {
			if ($event->get_id() == $id) {
				return $event;
			}
		}

		return null;
	}


	private function load_events() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		$data = $db->select(EVENTS_TABLE_NAME, "*", null, null);
		if (!$data) {
			return null;
		}
		
		$events = Array();
		foreach ($data as $item) {
			$id = $item['id'];
			$date = strtotime($item['_date']);
			$when = $item['_when'];
			$title = $item['title'];
			$description = $item['description'];
			$added_at = strtotime($item['added_at']);
			$added_by = $item['added_by'];

			$event = new Event($id, $date, $when, $title, $description, $added_at, $added_by);
			$events[] = $event;
		}
	
		return $events;
	}

	public function insert_event($event) {
	 $config = Configs::get()->get_config();
	 $db = new MysqlDatabase($config);

	 return $db->insert(EVENTS_TABLE_NAME, "(_date, _when, title, description, added_at, added_by)", "("
		 . "'" . date(MYSQL_DATE_FORMAT, $event->get_date()) . "', "
		 . "'" . $db->escape_string($event->get_when()) . "', "
		 . "'" . $db->escape_string($event->get_title()) . "', "
		 . "'" . $db->escape_string($event->get_description()) . "', "
		 . "'" . date(MYSQL_DATE_FORMAT, $event->get_added_at()) . "', "
		 . "'" . $event->get_added_by() . "'"
		 . ")");
	}

	public function update_event($event) {
	 $config = Configs::get()->get_config();
	 $db = new MysqlDatabase($config);

	 return $db->update(EVENTS_TABLE_NAME, ""
		 . "_date = '" . date(MYSQL_DATE_FORMAT, $event->get_date()) . "', "
		 . "_when = '" . $db->escape_string($event->get_when()) . "', "
		 . "title = '" . $db->escape_string($event->get_title()) . "', "
		 . "description = '" . $db->escape_string($event->get_description()) . "', "
		 . "added_at = '" . date(MYSQL_DATE_FORMAT, $event->get_added_at()) . "', "
		 . "added_by = '" . $event->get_added_by() . "'",
	 	"id = " . $event->get_id());
	}
	
	public function remove_event($event) {
	 $config = Configs::get()->get_config();
	 $db = new MysqlDatabase($config);

	 return $db->delete(EVENTS_TABLE_NAME, "id = " . $event->get_id());
	}
	
	public function is_ok() {
		return $this->events;
	}


	public function install() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		$created = $db->create_table(EVENTS_TABLE_NAME, "("
			. "id INTEGER NOT NULL AUTO_INCREMENT, "
			. "_date DATE NOT NULL, "
			. "_when CHAR(100), "
			. "title VARCHAR(200) NOT NULL, "
			. "description VARCHAR(1000) NOT NULL, "
			. "added_at DATETIME NOT NULL, "
			. "added_by CHAR(50) NOT NULL, "
			. "PRIMARY KEY (id), "
			. "FOREIGN KEY (added_by) REFERENCES " . ADMINS_TABLE_NAME . " (username)"
			. ")");

		$event = new Event(0, time(), 'Now', 'Events Calendar ready', 'The nanoadmin\'s Events Calendar installed!', time(), NANOADMIN_USERNAME);
		$inserted = $this->insert_event($event);

		return $created && $inserted;
	}

	public function uninstall() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		return $db->drop_table(EVENTS_TABLE_NAME);
	}

	public function __toString() {
		return "Quotes: " . count($this->events);
	}
}



?>
