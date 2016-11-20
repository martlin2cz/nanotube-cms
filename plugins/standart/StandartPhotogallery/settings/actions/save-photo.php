<?php require_once(__DIR__ . '/../../../../../nanoadmin/impl/ActionTemplate.php'); ?>
<?php ActionTemplate::before_start('../../../../../nanoadmin/', true); ?>

<?php
require_once(__DIR__ . '/../../../../../impl/LogingIn.php');
require_once(__DIR__ . '/../../../../../nanoadmin/impl/WebTools.php');
require_once(__DIR__ . '/../../../../../utils/FilesManager.php');
require_once(__DIR__ . '/../../database/Photos.php');

// infer params
$file_name = WebTools::require_posted_id('file-name', true);
$gallery_id = WebTools::require_posted_id('gallery-id', false);

$title = WebTools::require_posted_string('title', false);
$description = WebTools::require_posted_string('description', false);
$thumb_height = WebTools::require_posted_number('thumb-height', THUMBNAIL_MIN_HEIGHT, THUMBNAIL_MAX_HEIGHT);


// aditional params and check
$is_edit = $file_name != '';

ActionTemplate::check_errors();

if (!$is_edit) {
	$man = new FilesManager();
	$file = $man->get_uploaded_file('data');
	
	$file_name = $file['file_name'];
	$data = $file['data'];
	$mime = $file['type'];
}

ActionTemplate::check_errors();


// load/create data object
$photos = new Photos();
if ($is_edit) {
	$photo = $photos->get_photo($file_name, $gallery_id);
	if (!$photo) {
		Errors::add("Params error", "Photo $file_name does not exist.", false);
	}
} else {
	$photo = $photos->get_photo($gallery_id, $file_name);
	if ($photo) {
		Errors::add("Params error", "Photo $file_name alredy exists.", false);
	}
	$admin = LoggingIn::get()->logged_admin();
	$photo = new Photo($file_name, "", "", NULL, '', time(), $admin->get_username(), 0, 0, $gallery_id);
}

ActionTemplate::check_errors();

//modify data object
$photo->set_title($title);
$photo->set_description($description);
$photo->set_thumb_height($thumb_height);

if (!$is_edit) {
	$photo->set_data($data);
	$photo->set_mime($mime);
	
	$count = count($photos->photos_of($gallery_id));
	$order_num = $count + 1;
	$photo->set_order_num($order_num);
}


//save
if ($is_edit) {
	$succ = $photos->simple_update($photo);
} else {
	$succ = $photos->insert_photo($photo);
}

ActionTemplate::check_errors();
ActionTemplate::success("../?gallery-id=$gallery_id");
?>
