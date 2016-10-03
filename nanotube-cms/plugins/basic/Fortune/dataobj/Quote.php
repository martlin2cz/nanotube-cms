<?php

class Quote {
	private $dictionary_id;
	private $author;
	private $text;

	public function __construct($dictionary_id, $author, $text) {
		$this->dictionary_id = $dictionary_id;
		$this->author = $author;
		$this->text = $text;
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


	public function __toString() {
		return "Quote: " . $this->text . " by " . $this->text;
	}
}



?>
