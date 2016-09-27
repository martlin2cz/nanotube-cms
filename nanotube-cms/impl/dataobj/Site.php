<?php

class Site {
	private $id;
	private $title;
	private $content;
	private $created_by;
	private $created_at;
	private $last_modified_by;
	private $last_modified_at;
	private $visible;

	public function __construct($id, $title, $content, $created_by, $created_at, $last_modified_by, $last_modified_at, $visible) {
		$this->id = $id;
		$this->title = $title;
		$this->content = $content;
		$this->created_by = $created_by;
		$this->created_at = $created_at;
		$this->last_modified_by = $last_modified_by;
		$this->last_modified_at = $last_modified_at;
		$this->visible = $visible;
	}

	// getters

	public function get_id() {
		return $this->id;
	}

	public function get_title() {
		return $this->title;
	}

	public function get_content() {
		return $this->content;
	}

	public function get_created_by() {
		return $this->created_by;
	}

	public function get_created_at() {
		return $this->created_at;
	}

	public function get_last_modified_by() {
		return $this->last_modified_by;
	}

	public function get_last_modified_at() {
		return $this->last_modified_at;
	}

	public function is_visible() {
		return $this->visible;
	}
	// setters

	public function set_id($id) {
		$this->id = $id;
	}	

	public function set_title($title) {
		$this->title = $title;
	}	

	public function set_content($content) {
		$this->content = $content;
	}	
	
	public function set_created_at($created_at) {
		$this->created_at = $created_at;
	}	

	public function set_created_by($created_by) {
		$this->created_by = $created_by;
	}	

	public function set_last_modified_at($last_modified_at) {
		$this->last_modified_at = $last_modified_at;
	}	

	public function set_last_modified_by($last_modified_by) {
		$this->last_modified_by = $last_modified_by;
	}	

	public function set_visible($visible) {
		$this->visible = $visible;
	}

	// others

	public function __toString() {
		return "Site: " . $this->id;
	}
}



?>
