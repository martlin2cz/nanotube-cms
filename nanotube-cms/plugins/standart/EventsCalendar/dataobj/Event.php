<?php

class Event {
	private $id;
	private $date;
	private $when;
	private $title;
	private $description;
	private $added_at;
	private $added_by;

	public function __construct($id, $date, $when, $title, $description, $added_at, $added_by) {
		$this->id = $id;
		$this->date = $date;
		$this->when = $when;
		$this->title = $title;
		$this->description = $description;
		$this->added_at = $added_at;
		$this->added_by = $added_by;
	}

	// getters

	public function get_id() {
		return $this->id;
	}

	public function get_date() {
		return $this->date;
	}
	
	public function get_when() {
		return $this->when;
	}
	
	public function get_title() {
		return $this->title;
	}
	
	public function get_description() {
		return $this->description;
	}
	
	public function get_added_at() {
		return $this->added_at;
	}
	
	public function get_added_by() {
		return $this->added_by;
	}
	
	// setters
	
	public function set_date($date) {
		$this->date = $date;
	}

	public function set_when($when) {
		$this->when = $when;
	}

	public function set_title($title) {
		$this->title = $title;
	}

	public function set_description($description) {
		$this->description = $description;
	}

	public function set_added_by($added_by) {
		$this->added_by = $added_by;
	}

	public function set_added_at($added_at) {
		$this->added_at = $added_at;
	}

	// others
	
	public function __toString() {
		return "Event: " . $this->title;
	}
}



?>
