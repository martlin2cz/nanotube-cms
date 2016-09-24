<?php

require_once(__DIR__. '/Quote.php');

class Quotes {
	private $quotes;

	public function __construct() {
	
		$this->quotes = Array(
			new Quote("Douglas Adams", "The answer is 42"),
			new Quote("Bill Gates", "640kB should be enough for everyone"),
			new Quote("Linus Torvalds", "We all know linux is great. It does infinite loop in 13 seconds.")
		);
	}

	public function all_quotes() {
		return $this->quotes;
	}
	
	public function get_random_quote() {
		$index = rand(0, count($this->quotes) - 1);
		return $this->quotes[$index];
	}

	public function __toString() {
		return "Quotes: " . count($this->sites);
	}
}



?>
