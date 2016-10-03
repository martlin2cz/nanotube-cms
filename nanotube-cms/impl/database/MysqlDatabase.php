<?php

require_once(__DIR__ . '/../dataobj/Config.php');
require_once(__DIR__ . '/../Errors.php');

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

		return $this->check_connection_error();
	}

	private function check_connection_error() {
		if ($this->connection->connect_errno) {
			error_log("Connecting ERROR: " . $this->connection->connect_error);
			Errors::add("Database error", "Could not connect to database. MySQL error code:" . $this->connection->connect_errno, true);
			return false;
		} else {
			return true;
		}
	}

	private function check_error($operation) {
		if ($this->connection->errno) {
			error_log("Query ERROR: " . $this->connection->error);
			Errors::add("Database error", "Could not perform $operation. MySQL error code:" . $this->connection->connect_errno, true);
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
		return $this->check_error("creating of table $name");
	}

	public function drop_table($name) {
		$this->connect();
		$sql = "DROP TABLE $name";

		$this->invoke_sql($sql);
		return $this->check_error("deleting of table $name");
	}

	public function insert($table, $columns, $values) {
		$this->connect();
		$sql = "INSERT INTO $table $columns VALUES $values";

		$this->invoke_sql($sql);
		return $this->check_error("data insert into table $table");
	}
	
	public function update($table, $sets, $where) {
		$this->connect();
		$sql = "UPDATE $table SET $sets";
		if ($where) {
			$sql .= " WHERE $where";
		}

		$this->invoke_sql($sql);
		return $this->check_error("data update in table $table");
	}
	
	public function delete($table, $where) {
		$this->connect();
		$sql = "DELETE FROM $table";
		if ($where) {
			$sql .= " WHERE $where";
		} else {
			Errors::add("Params error", "No where clausule specified when removing.");
			return false;
		}

		$this->invoke_sql($sql);
		return $this->check_error("data removing from table $table");
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
		$this->check_error("loading data from table $table");
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

		$this->check_error("testing of database");
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
