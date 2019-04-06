<?php require_once(__DIR__ . '/../../../../../nanoadmin/impl/ActionTemplate.php'); ?>
<?php ActionTemplate::before_start('../../../../../nanoadmin/', true); ?>

<?php
require_once(__DIR__ . '/../../../../../nanoadmin/impl/WebTools.php');
require_once(__DIR__ . '/../../../../../utils/FilesManager.php');
require_once(__DIR__ . '/../../database/Photos.php');

// infer params
$gallery_id = WebTools::require_posted_id('gallery-id', false);
$thumb_height = WebTools::require_posted_number('thumb-height', THUMBNAIL_MIN_HEIGHT, THUMBNAIL_MAX_HEIGHT);

ActionTemplate::check_errors();

ActionTemplate::check_errors();

$photos = new Photos();

//save
$succ = $photos->update_gallery($gallery_id, $thumb_height);

ActionTemplate::check_errors();
ActionTemplate::success("../?gallery-id=$gallery_id");
?>
