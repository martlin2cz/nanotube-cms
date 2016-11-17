<?php

class AditionalPageConfig {
	private $pre_heads;
	private $post_heads;
	private $before_content;
	private $after_content;
	private $title_suffix;

	public function __construct() {
		$this->pre_heads = Array();
		$this->post_heads = Array();
		$this->before_content = Array();
		$this->after_content = Array();
		$this->title_suffix = null;
	}

	public function get_pre_heads() {
		return $this->pre_heads;
	}
	
	public function get_post_heads() {
		return $this->post_heads;
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

	public function add_pre_head($head) {
		$this->pre_heads[] = $head;
	}

	public function add_post_head($head) {
		$this->post_heads[] = $head;
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
		return "AditionalPageConfig: ...";
	}
}



?>
