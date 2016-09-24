<?php

class Site {
	private $id;
	private $title;
	private $content;

	public function __construct($id, $title, $content) {
		$this->id = $id;
		$this->title = $title;
		$this->content = $content;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_title() {
		return $this->title;
	}

	public function get_content() {
		return $this->content;
	}

	//TODO modify
	
	public function __toString() {
		return "Site: " . $this->id;
	}
}



?>
