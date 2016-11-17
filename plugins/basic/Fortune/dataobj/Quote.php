<?php

class Quote {
	private $id;
	private $dictionary_id;
	private $author;
	private $text;

	public function __construct($id, $dictionary_id, $author, $text) {
		$this->id = $id;
		$this->dictionary_id = $dictionary_id;
		$this->author = $author;
		$this->text = $text;
	}

	// getters

	public function get_id() {
		return $this->id;
	}

	public function get_dictionary_id() {
		return $this->dictionary_id;
	}

	public function get_author() {
		return $this->author;
	}

	public function get_text() {
		return $this->text;
	}

	// setters
	
	public function set_dictionary_id($dictionary_id) {
		$this->dictionary_id = $dictionary_id;
	}

	public function set_author($author) {
		$this->author = $author;
	}
	
	public function set_text($text) {
		$this->text = $text;
	}
	
	// others
	
	public function __toString() {
		return "Quote: " . $this->text . " by " . $this->text;
	}
}



?>
