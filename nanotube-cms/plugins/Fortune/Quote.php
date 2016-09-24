<?php

class Quote {
	private $author;
	private $text;

	public function __construct($author, $text) {
		$this->author = $author;
		$this->text = $text;
	}

	public function get_author() {
		return $this->author;
	}

	public function get_text() {
		return $this->text;
	}

	public function __toString() {
		return "Quote: " . $this->text . " by " . $this->text;
	}
}



?>
