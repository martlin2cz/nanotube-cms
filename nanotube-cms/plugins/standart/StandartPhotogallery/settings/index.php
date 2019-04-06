<?php require_once(__DIR__ . '/../../../../nanoadmin/impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('../../../../nanoadmin/', 'Photo galleries', true, 
	'<link rel="stylesheet" href="../css/custom-styles.css" type="text/css" />' .
	'<link rel="stylesheet" href="css/settings.css" type="text/css" />' .
	'<script src="js/editor.js" type="text/javascript"></script>'
); ?>

<?php
require_once(__DIR__ . '/../database/Photos.php');
require_once(__DIR__ . '/../../../../nanoadmin/impl/WebTools.php');

$photos = new Photos();

?>
<?php NAtemplate::check_errors() ?>

<?php 

$gallery_id_choosen = WebTools::require_getted_or_not('gallery-id-choosen');
$gallery_id_new = WebTools::require_getted_or_not('gallery-id-new');
$gallery_id = WebTools::require_getted_or_not('gallery-id');

if ($gallery_id_choosen != '') {
	$gallery_id = $gallery_id_choosen;
}
if ($gallery_id_new != '') {
	$gallery_id = $gallery_id_new;
}

?>
<?php NAtemplate::check_errors() ?>


<form method="GET">
	<fieldset>
	<legend><h2>Gallery</h2></legend>

		<label>Choose gallery:</label>
		<select name="gallery-id-choosen">
				<option value="">---</option>
				<?php foreach ($photos->galleries() as $gal_id) { ?>
					<option  value="<?= $gal_id ?>" <?= $gal_id == $gallery_id ? 'selected=""' : '' ?>><?= $gal_id ?></option>
				<?php } ?>
		</select>
		<input type="submit" value="Choose" >
		<label>Or create new:</label>
		<input type="text" name="gallery-id-new" placeholder="gallery-id" >
		<input type="submit" value="Create" >
	</fieldset>
</form>

<form method="POST" action="actions/save-gallery.php">
	<fieldset>
		<legend><h2>Gallery settings</h2></legend>
		<input type="hidden" name="gallery-id" value="<?= $gallery_id ?>">
	
 		<label>Thumbnail size</label>
		<input type="number" name="thumb-height" value="" min="<?= THUMBNAIL_MIN_HEIGHT ?>" max="<?= THUMBNAIL_MAX_HEIGHT ?>">
    <span class="note">Specify height (in lines) of the thumbnail image, will override setting of all photos(!)</span>

    <div class="buttons-panel">
      <input type="submit" value="Submit">
      <input type="reset" value="Revert">
    </div>
	</fieldset>
</form>

<?php if (!is_null($gallery_id)) { ?>
<h2>Photos</h2>
<section>
	<?php foreach ($photos->photos_of($gallery_id) as $photo) { ?>
		<div class="image-panel">
			<img src="../impl/image.php?gallery=<?= $gallery_id ?>&amp;name=<?= $photo->get_file_name() ?>" 
				alt="<?= $photo->get_title() ?>"
				class="<?= $photos->get_css_of_thumbnail($photo) ?>">

			<p><?= $photo->get_title() ?></p>	
			<form method="GET">
				<a href="#" onclick="return moveTo(this, 'left');">&larr;</a>
				<input type="hidden" name="move" id="dir-hidden" value="">
				<input type="hidden" name="file-name" value="<?= $photo->get_file_name() ?>">
				<input type="hidden" name="gallery-id" value="<?= $gallery_id ?>">
				<input type="submit" value="Edit" formaction="edit-photo.php">
				<input type="submit" value="Delete" formaction="actions/delete-photo.php" onclick="return confirm('Are you sure?');">
				<a href="#" onclick="return moveTo(this, 'right');">&rarr;</a>
			</form>
		</div>
	<?php } ?>
	<div class="image-panel">
		<form method="GET">
			<input type="hidden" name="gallery-id" value="<?= $gallery_id ?>">
			<input type="submit" value="Upload new photo" formaction="edit-photo.php">
		</form>
	</div>
</section>
<?php } ?>

<?php NAtemplate::after_content(); ?>
