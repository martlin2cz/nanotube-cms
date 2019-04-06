<?php

class NanoError {
	private $title;
	private $message;
	private $is_critical;

	public function __construct($title, $message, $is_critical) {
		$this->title = $title;
		$this->message = $message;
		$this->is_critical = $is_critical;
	}

	// getters

	public function get_title() {
		return $this->title;
	}

	public function get_message() {
		return $this->message;
	}

	public function is_critical() {
		return $this->is_critical;
	}
	
	// others

	public function __toString() {
		return "NanoError: " . $this->title . " (" . $this->message . ")";
	}
}



?>
