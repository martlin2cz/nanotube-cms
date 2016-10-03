<?php

require_once(__DIR__. '/../dataobj/Quote.php');
require_once(__DIR__. '/../../../../impl/database/MysqlDatabase.php');

define("QUOTES_TABLE_NAME", "ntp_quotes");

class Quotes {
	private $quotes;


	public function __construct() {
		$this->quotes = $this->load_quotes();
	}

	public function all_quotes($dictionary_id) {
		$quotes = $this->all_quotes_real($dictionary_id);
		if (!$quotes) {
			$quotes = Array(new Quote("Server", "Something went wrong ..."));
		}
		return $quotes;
	}
	
	public function all_quotes_real($dictionary_id) {
		if ($dictionary_id) {
			if (isset($this->quotes[$dictionary_id])) {
				return $this->quotes[$dictionary_id];
			}
		}

		return $this->merge_all_dictionaries();
	}

	public function get_random_quote($dictionary_id) {
		$quotes = $this->all_quotes($dictionary_id);
		$index = rand(0, count($quotes) - 1);
		return $quotes[$index];
	}

	public function get_quote($id) {
		foreach ($this->all_quotes(null) as $quote) {
			if ($quote->get_id() == $id) {
				return $quote;
			}
		}

		return null;
	}



	public function get_all_dictionaries() {
		return array_keys($this->quotes);
	}

	private function merge_all_dictionaries() {
		return call_user_func_array("array_merge", $this->quotes);
	}


	private function load_quotes() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		$data = $db->select(QUOTES_TABLE_NAME, "*", null, null);
		if (!$data) {
			return null;
		}
		
		$quotes = Array();
		foreach ($data as $item) {
			$id = $item['id'];
			$dictionary_id = $item['dictionary_id'];
			$text = $item['text'];
			$author = $item['author'];

			$quote = new Quote($id, $dictionary_id, $author, $text);
			$quotes[$dictionary_id][] = $quote;
		}
	
		return $quotes;
	}

	public function insert_quote($quote) {
	 $config = Configs::get()->get_config();
	 $db = new MysqlDatabase($config);

	 return $db->insert(QUOTES_TABLE_NAME, "(dictionary_id, author, text)", "("
		 . "'" . $quote->get_dictionary_id() . "', "
		 . "'" . $db->escape_string($quote->get_author()) . "', "
		 . "'" . $db->escape_string($quote->get_text()) . "'"
		 . ")");
	}

	public function update_quote($quote) {
	 $config = Configs::get()->get_config();
	 $db = new MysqlDatabase($config);

	 return $db->update(QUOTES_TABLE_NAME, 
		   "dictionary_id = '" . $quote->get_dictionary_id() . "', "
		 . "author = '" . $db->escape_string($quote->get_author()) . "', "
		 . "text = '" . $db->escape_string($quote->get_text()) . "'",
			 "id = " . $quote->get_id());
	}
	
	public function remove_quote($quote) {
	 $config = Configs::get()->get_config();
	 $db = new MysqlDatabase($config);

	 return $db->delete(QUOTES_TABLE_NAME, "id = " . $quote->get_id());
	}
	
	public function is_ok() {
		return $this->all_quotes_real(null);
	}


	public function install() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		$created = $db->create_table(QUOTES_TABLE_NAME, "("
			. "id INTEGER NOT NULL AUTO_INCREMENT, "
			. "dictionary_id CHAR(50) NOT NULL, "
			. "author CHAR(100), "
			. "text VARCHAR(1000) NOT NULL, "
			. "PRIMARY KEY (id)"
			. ")");
		$inserted1 = $db->insert(QUOTES_TABLE_NAME, "(dictionary_id, author, text)", 
			"('it', 'Linus Torvalds', 'We all know linux is great. It does infinite loop in 13 seconds.')");
		$inserted2 =  $db->insert(QUOTES_TABLE_NAME, "(dictionary_id, author, text)", 
			"('it', 'Bill Gates', '640kB should be enough for everyone')");
		return $created && $inserted1 && $inserted2;
	}

	public function uninstall() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		return $db->drop_table(QUOTES_TABLE_NAME);
	}
	public function __toString() {
		return "Quotes: " . count($this->quotes);
	}
}



?>
