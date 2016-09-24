<?php

class AditionalPageConfig {
	private $heads;
	private $before_content;
	private $after_content;
	private $title_suffix;

	public function __construct() {
		$this->heads = Array();
		$this->before_content = Array();
		$this->after_content = Array();
		$this->title_suffix = null;
	}

	public function get_heads() {
		return $this->heads;
	}

	public function get_before_content() {
		return $this->before_content;
	}

	public function get_after_content() {
		return $this->after_content;
	}

	public function get_title_suffix() {
		return $this->title_suffix;
	}

	public function add_head($head) {
		$this->heads[] = $head;
	}
	
	public function add_before_content($before) {
		$this->before_content[] = $before;
	}
	
	public function add_after_content($after) {
		$this->after_content[] = $after;
	}
	
	public function set_title_suffix($title_suffix) {
		$this->title_suffix = $title_suffix;
	}
	
	public function __toString() {
		return "AditionalPageConfig, heads=" . count($this->heads) . ", before_content="   . count($this->before_content) . ", aftere_content=". count($this->after_content);
	}
}



?>
