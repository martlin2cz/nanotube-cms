<?php require_once(__DIR__ . '/../../../../nanoadmin/impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('../../../../nanoadmin/', "Edit photo", true, 
	'<link rel="stylesheet" href="../css/custom-styles.css" type="text/css" />'
); ?>

<?php
require_once(__DIR__ . '/../database/Photos.php');
require_once(__DIR__ . '/../../../../nanoadmin/impl/WebTools.php');

// infer params
$file_name = isset($_GET) && isset($_GET['file-name']) ? $_GET['file-name'] : "";
$gallery_id = WebTools::require_getted_string('gallery-id', false);

$photos = new Photos();

if ($file_name != null) {
	$photo = $photos->get_photo($file_name, $gallery_id);
	if (!$photo) {
		Errors::add("Params error", "Photo $file_name does not exist.", true);
	}	
} else {
	$photo = null;
}

$is_edit = $photo != null;

if (!$photo) {
	$photo = new Photo('photo.jpg', 'The photo', 'This is a photo.',  NULL, 'image', time(), NANOADMIN_USERNAME, 0, THUMBNAIL_MIN_HEIGHT, $gallery_id);
}

NAtemplate::check_errors();
?>

	<form action="actions/save-photo.php" method="POST" <?= $is_edit ? '' : 'enctype="multipart/form-data"' ?> >
	<fieldset>
		<legend><h2>Modify/Upload photo</h2></legend>
		<input type="hidden" name="file-name" value="<?= $file_name ?>">
		<input type="hidden" name="gallery-id" value="<?= $gallery_id ?>">

		<?php if ($is_edit) { ?>	
		<label>Preview</label>	
		<img src="../impl/image.php?gallery=<?= $gallery_id ?>&amp;name=<?= $photo->get_file_name() ?>" 
        alt="<?= $photo->get_title() ?>"
        class="<?= $photos->get_css_of_thumbnail($photo) ?>">
		<?php } else { ?>
			<label>Choose file</label>	
			<input type="file" name="data">
		<?php } ?>

		<label>Title</label>
		<input type="text" name="title" value="<?= $photo->get_title() ?>">

		<label>Description</label>
		<textarea name="description"><?= $photo->get_description() ?></textarea>

		<label>Thumbnail size</label>
		<input type="number" name="thumb-height" value="<?= $photo->get_thumb_height() ?>" min="<?= THUMBNAIL_MIN_HEIGHT ?>" max="<?= THUMBNAIL_MAX_HEIGHT ?>">
		<span class="note">Specify height (in lines) of the thumbnail image</span>

		<div class="buttons-panel">
			<input type="submit" value="Submit">		
			<input type="reset" value="Revert">
		</div>
	</fieldset>
</form>
<?php NAtemplate::after_content();
