<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../database/Photos.php');
require_once(__DIR__ . '/../../../../../nanoadmin/impl/WebTools.php');
require_once(__DIR__ . '/../../../../../nanoadmin/impl/ActionTemplate.php');


ActionTemplate::before_start("../../../../../nanoadmin/", true);

// check params
$file_name = WebTools::require_getted_id('file-name', false);
$gallery_id = WebTools::require_getted_id('gallery-id', false);

$dir = WebTools::require_getted_string('move', false);

ActionTemplate::check_errors();
if (!($dir == "left" || $dir == "right")) {
	Errors::add("Invalid param", "Photo can be moved <em>left</em> or <em>right</em>.", false);
	ActionTemplate::check_errors();
}
$is_left = ($dir == "left");

// load both afficted data objects
$photos = new Photos();
$photo = $photos->get_photo_of($file_name, $gallery_id);

if (is_null($photo)) {
	Errors::add("Not found", "Photo $file_name not found", false);
	ActionTemplate::check_errors();
}

//swap their order_nums
$twin_order = $photo->get_order_num() + ($is_left ? -1 : +1);
$twin = $photos->get_photo_with_order($twin_order, $gallery_id);

if ($twin) {
	$tmp = $photo->get_order_num();
	$photo->set_order_num($twin->get_order_num());
	$twin->set_order_num($tmp);
}

// save changed
$photos->simple_update($photo);
if ($twin) {
	$photos->simple_update($twin);
}

ActionTemplate::check_errors();
ActionTemplate::success("../?gallery-id=$gallery_id");

?>

