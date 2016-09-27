<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>
<?php NAtemplate::before_document(true, '../'); ?>
<?php

require_once(__DIR__ . '/../../impl/database/Sites.php');

if (isset($_GET) && isset($_GET['site-id'])) {
	$site_id = $_GET['site-id'];
} else {
	$site_id = null;
}

if ($site_id) {
	$sites = Sites::get();
	$site = $sites->get_site($site_id);
	$is_edit = true;
} else {
	$site = new Site('unique-id-of-your-site', 'Title of your site', '<p>Text (html) of your site.</p>');
	$is_edit = false;
}

function is_edit() {
	global $is_edit;
	return $is_edit;
}

function edit_or_new_text($edit_text, $new_text) {
	if (is_edit()) {
		return $edit_text;
	} else {
		return $new_text;
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<?php NAtemplate::head(edit_or_new_text('Edit', 'Create') . ' site'); ?>
	</head>
	<body>
		<?php NAtemplate::before_content(); ?>
			<h1><?= edit_or_new_text('Edit', 'Create') ?> site</h1>

			<form action="actions/update-site.php" method="POST">
				<input type="hidden" name="current-site-id" value="<?= edit_or_new_text($site->get_id(), '') ?>">

				<label>Site id</label>
				<input type="text" name="site-id" value="<?= $site->get_id() ?>">
				<?php if (is_edit()) { ?>
				<span>note: changing the site id will not cause to update links to this site in other sites!</span>
				<?php } ?>

	<br>

				<label>Site title</label>
				<input type="text" name="title" value="<?= $site->get_title() ?>">

	<br>

				<label>Text</label>
				<textarea name="content"><?= $site->get_content() ?></textarea>

	<br>

				<input type="checkbox" checked="<?= $site->is_visible() ?>">
				<label>Visible</label>


	<br>

				<input type="submit" value="<?= edit_or_new_text('Update', 'Create') ?>">
</form>		

<?php NAtemplate::after_content(); ?>
	</body>
</html>
