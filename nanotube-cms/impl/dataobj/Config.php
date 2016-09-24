<?php

class Config {
	private $web_title;

	public function __construct($web_title) {
		$this->web_title = $web_title;
	}

	public function get_web_title() {
		return $this->web_title;
	}

	//TODO modify
	
	public function __toString() {
		return "Web config, web_title=" . $this->web_title;
	}
}



?>
