<?php require_once(__DIR__ . '/../../../../../nanoadmin/impl/ActionTemplate.php'); ?>
<?php ActionTemplate::before_start('../../../../../nanoadmin/', true); ?>

<?php
require_once(__DIR__ . '/../../../../../nanoadmin/impl/WebTools.php');
require_once(__DIR__ . '/../../database/Photos.php');

// infer params
$file_name = WebTools::require_getted_string('file-name', false);
$gallery_id = WebTools::require_getted_id('gallery-id', false);

ActionTemplate::check_errors();

// load/create data object
$photos = new Photos();
$photo = $photos->get_photo_of($file_name, $gallery_id);
if (!$photo) {
	Erorrs::add("Params error", "Photo $file_name does not exist.", false);
}

ActionTemplate::check_errors();

//save
$succ = $photos->remove_photo($photo);

ActionTemplate::check_errors();
ActionTemplate::success("../?gallery-id=$gallery_id");
?>
