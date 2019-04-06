<?php

class FilesManager {

	public function get_uploaded_file($field_name) {
		if (!(isset($_FILES) && isset($_FILES[$field_name]))) {
			return NULL;
		}
		$file_name = $_FILES[$field_name]['name'];
		$path = $_FILES[$field_name]['tmp_name'];
		$mime = $_FILES[$field_name]['type'];

		$file = fopen($path, "rb");
		$data = fread($file, filesize($path));
		fclose($file);

		return Array('file_name' => $file_name, 'type' => $mime, 'data' => $data);
	}

	public function download_file($name, $mime, $data) {
		header("Content-type: $mime");
		//header("Content-Disposition: attachment; filename=$name");
		echo $data;	//TODO

	}


}


?>
