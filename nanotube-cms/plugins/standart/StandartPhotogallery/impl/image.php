<?php

require_once(__DIR__ . '/../database/Photos.php');
require_once(__DIR__ . '/../../../../utils/FilesManager.php');
require_once(__DIR__ . '/../../../../nanoadmin/impl/WebTools.php');

//infer params
$gallery_id = WebTools::require_getted_string('gallery', true);
$file_name = WebTools::require_getted_string('name', false);


$photos = new Photos();

//find data object

if ($gallery_id == '') {
	$photo = $photos->get_photo($file_name);
} else {
	$photo = $photos->get_photo_of($file_name, $gallery_id);
}

if (is_null($photo)) {
	//TODO 404 not found
	die("Photo $file_name not found!");
}

//render photo
//TODO mime etc.

$man = new FilesManager();

$man->download_file($photo->get_file_name(), $photo->get_mime(), $photo->get_data());

//echo " OK ";

?>
