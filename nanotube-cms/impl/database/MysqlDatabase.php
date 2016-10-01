<?php

require_once(__DIR__ . '/../dataobj/Config.php');
define("MYSQL_DATE_FORMAT", 'Y-m-d H:i:s');

class MysqlDatabase {
	
	private $config;
	private $connection;

	public function __construct($config) {
		$this->config = $config;
	}

	private function connect() {
		$this->connection = new mysqli(
			$this->config->get_mysql_server(),
			$this->config->get_mysql_user(),
			$this->config->get_mysql_password(),
			$this->config->get_mysql_database());

		if ($this->connection->connect_errno) {
			error_log("Connecting ERROR: " . $this->connection->connect_error);
			return false;
		}

		return true;
	}

	private function check_error() {
		if ($this->connection->errno) {
			error_log("Query ERROR: " . $this->connection->error);
			
			return false;
		} else {
			return true;
		}
	}

	private function invoke_sql($sql) {
		echo "<pre>[$sql]</pre>\n";//XXX debug!
		return $this->connection->query($sql); 
	}

	public function create_table($name, $spec) {
		$this->connect();
		$sql = "CREATE TABLE $name $spec";

		$this->invoke_sql($sql);
		return $this->check_error();
	}

	public function drop_table($name) {
		$this->connect();
		$sql = "DROP TABLE $name";

		$this->invoke_sql($sql);
		return $this->check_error();
	}

	public function insert($table, $columns, $values) {
		$this->connect();
		$sql = "INSERT INTO $table $columns VALUES $values";

		$this->invoke_sql($sql);
		return $this->check_error();
	}
	
	public function update($table, $sets, $where) {
		$this->connect();
		$sql = "UPDATE $table SET $sets";
		if ($where) {
			$sql .= " WHERE $where";
		}

		$this->invoke_sql($sql);
		return $this->check_error();
	}

	public function select($table, $columns, $where, $order) {
		$this->connect();
		$sql = "SELECT $columns FROM  $table";
		if ($where) {
			$sql .= " WHERE $where";
		}
		if ($order) {
			$sql .= " ORDER BY $order";
		}

		$result = $this->invoke_sql($sql);
		$this->check_error();
		if ($result) {
			return $this->result_to_array($result);
		} else {
			return null;
		}
	}

	public function test() {
		$this->connect();

		$sql = "SELECT 'It works!'";
		$result = $this->invoke_sql($sql);

		$this->check_error();
		return $result;
	}

	private function result_to_array($result) {
		$array = Array();

		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$array[] = $row;
		}
		
		$result->free();
		return $array;
	}

	public function escape_string($string) {
		$this->connect();
		return $this->connection->real_escape_string($string);
	}	
	
	public function bool_to_sql($bool) {
		if ($bool) {
			return "1";
		} else {
			return "0";
		}
	}	


}
