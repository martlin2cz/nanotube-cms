<?php

class Photo {
	private $file_name;
	private $title;
	private $description;
	private $data;
	private $mime;
	private $uploaded_at;
	private $uploaded_by;
	private $order_num;
	private $thumb_height;
	private $gallery_id;

	public function __construct($file_name,  $title, $description, $data, $mime, $uploaded_at, $uploaded_by, $order_num, $thumb_height, $gallery_id) {
		$this->file_name = $file_name;
		$this->title = $title;
		$this->description = $description;
		$this->data = $data;
		$this->mime = $mime;
		$this->uploaded_at = $uploaded_at;
		$this->uploaded_by = $uploaded_by;
		$this->order_num = $order_num;
		$this->thumb_height = $thumb_height;
		$this->gallery_id = $gallery_id;
	}

	// getters

	public function get_file_name() {
		return $this->file_name;
	}
		
	public function get_title() {
		return $this->title;
	}
	
	public function get_description() {
		return $this->description;
	}
		
	public function get_data() {
		return $this->data;
	}
		
	public function get_mime() {
		return $this->mime;
	}
	
	public function get_uploaded_at() {
		return $this->uploaded_at;
	}
	
	public function get_uploaded_by() {
		return $this->uploaded_by;
	}
		
	public function get_order_num() {
		return $this->order_num;
	}
	
	
	public function get_thumb_height() {
		return $this->thumb_height;
	}
		
	public function get_gallery_id() {
		return $this->gallery_id;
	}
	
	// setters
	
	public function set_file_name($file_name) {
		$this->file_name = $file_name;
	}

	public function set_title($title) {
		$this->title = $title;
	}

	public function set_description($description) {
		$this->description = $description;
	}

	public function set_data($data) {
		$this->data = $data;
	}

	public function set_mime($mime) {
		$this->mime = $mime;
	}

	public function set_uploaded_by($uploaded_by) {
		$this->uploaded_by = $uploaded_by;
	}

	public function set_uploaded_at($uploaded_at) {
		$this->uploaded_at = $uploaded_at;
	}

	public function set_order_num($order_num) {
		$this->order_num = $order_num;
	}

	public function set_thumb_height($thumb_height) {
		$this->thumb_height = $thumb_height;
	}


	// others
	
	public function __toString() {
		return "Photo: " . $this->title;
	}
}



?>
