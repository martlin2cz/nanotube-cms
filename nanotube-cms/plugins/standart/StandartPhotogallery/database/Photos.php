<?php

require_once(__DIR__. '/../dataobj/Photo.php');
require_once(__DIR__. '/../../../../impl/database/MysqlDatabase.php');
require_once(__DIR__. '/../../../../impl/database/Admins.php');

define("THUMBNAIL_MIN_HEIGHT", 2);
define("THUMBNAIL_MAX_HEIGHT", 10);
define("MAX_IMAGE_SIZE", 10000000);	//10M



define("PHOTOS_TABLE_NAME", "ntp_photos");

class Photos {
	private $photos;


	public function __construct() {
		$this->photos = $this->load_photos();
	}
	public function get_css_of_thumbnail($photo) {
		return "thumbnail-h" . $photo->get_thumb_height() . "em";
	}

	public function galleries() {
		return array_keys($this->photos);
	}

	public function photos_of($gallery_id) {
		if (isset($this->photos[$gallery_id])) {
			return $this->photos[$gallery_id];
		} else {
			return Array();
		}
	}

	
	public function get_photo($file_name) {
		foreach ($this->galleries() as $gallery_id) {
			$photo = $this->get_photo_of($file_name, $gallery_id);
			if (!is_null($photo)) {
				return $photo;
			}
		}

		return null;
	}

	public function get_photo_of($file_name, $gallery_id) {
		if (isset($this->photos[$gallery_id][$file_name])) {
			return $this->photos[$gallery_id][$file_name];
		} else {
			return NULL;
		}
	}

	public function get_photo_with_order($order_num, $gallery_id) {

		foreach ($this->photos_of($gallery_id) as $photo) {
			if ($photo->get_order_num() == $order_num) {
				return $photo;
			}
		}

		return null;
	}

	private function load_photos() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		$data = $db->select(PHOTOS_TABLE_NAME, "*", null, "order_num");
		if (!$data) {
			return null;
		}
		
		$photos = Array();
		foreach ($data as $item) {
			$file_name = $item['file_name'];
			$title = $item['title'];
			$description = $item['description'];
			$uploaded_at = strtotime($item['uploaded_at']);
			$uploaded_by = $item['uploaded_by'];
			$data = $item['data'];
			$mime = $item['mime'];
			$order_num = $item['order_num'];
			$thumb_height = $item['thumb_height'];
			$gallery_id = $item['gallery_id'];

			$photo = new Photo($file_name, $title, $description, $data, $mime, $uploaded_at, $uploaded_by, $order_num, $thumb_height, $gallery_id);
			$photos[$gallery_id][$file_name] = $photo;
		}
		
		return $photos;
	}

	public function insert_photo($photo) {
	 $config = Configs::get()->get_config();
	 $db = new MysqlDatabase($config);

	 return $db->insert(PHOTOS_TABLE_NAME, 
		 "(file_name, title, description, uploaded_at, uploaded_by, data, mime, order_num, thumb_height, gallery_id)", 
		 "("
		 . "'" . $db->escape_string($photo->get_file_name()) . "', "
		 . "'" . $db->escape_string($photo->get_title()) . "', "
		 . "'" . $db->escape_string($photo->get_description()) . "', "
		 . "'" . date(MYSQL_DATE_FORMAT, $photo->get_uploaded_at()) . "', "
		 . "'" . $photo->get_uploaded_by() . "', "
		 . "'" . $db->escape_string($photo->get_data()) . "', "
		 . "'" . $photo->get_mime() . "', "
		 . "" . $photo->get_order_num() . ", "
		 . "" . $photo->get_thumb_height() . ", "
		 . "'" . $db->escape_string($photo->get_gallery_id()) . "'"
		 . ")");
	}

	public function simple_update($photo) {
	 $config = Configs::get()->get_config();
	 $db = new MysqlDatabase($config);

	 return $db->update(PHOTOS_TABLE_NAME, ""
		 . "title = '" . $db->escape_string($photo->get_title()) . "', "
		 . "description = '" . $db->escape_string($photo->get_description()) . "', "
		 . "order_num = " . $photo->get_order_num() . ", "
 		 . "thumb_height = " . $photo->get_thumb_height() . "",
		 "file_name = '" . $db->escape_string($photo->get_file_name()) . "' AND " . "gallery_id = '" . $db->escape_string($photo->get_gallery_id()) . "'");
	}
	
	public function remove_photo($photo) {
	 $config = Configs::get()->get_config();
	 $db = new MysqlDatabase($config);

	 return $db->delete(PHOTOS_TABLE_NAME, 
		 "file_name = '" . $db->escape_string($photo->get_file_name()) . "' AND " . "gallery_id = '" . $db->escape_string($photo->get_gallery_id()) . "'");
	}

	public function update_gallery($gallery_id, $thumb_height) {
		$config = Configs::get()->get_config();
	 $db = new MysqlDatabase($config);

	 return $db->update(PHOTOS_TABLE_NAME, ""
 		 . "thumb_height = " . $thumb_height . "",
			"gallery_id = '" . $db->escape_string($gallery_id) . "'");
	}

	public function is_ok() {
		return !($this->photos === NULL);
	}


	public function install() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		return $db->create_table(PHOTOS_TABLE_NAME, "("
			. "file_name CHAR(100) NOT NULL, "
			. "gallery_id CHAR(50) NOT NULL, "
			. "title VARCHAR(200) NOT NULL, "
			. "description VARCHAR(1000) NOT NULL, "
			. "uploaded_at DATETIME NOT NULL, "
			. "uploaded_by CHAR(50) NOT NULL, "
			. "data VARBINARY(" . MAX_IMAGE_SIZE . ") NOT NULL, "
			. "mime CHAR(50) NOT NULL, "
			. "order_num INTEGER NOT NULL, "
			. "thumb_height INTEGER NOT NULL, "
			. "PRIMARY KEY (file_name, gallery_id), "
			. "FOREIGN KEY (uploaded_by) REFERENCES " . ADMINS_TABLE_NAME . " (username)"
			. ")");
	}

	public function uninstall() {
		$config = Configs::get()->get_config();
		$db = new MysqlDatabase($config);

		return $db->drop_table(PHOTOS_TABLE_NAME);
	}

	public function __toString() {
		return "Quotes: " . count($this->photos);
	}
}



?>
