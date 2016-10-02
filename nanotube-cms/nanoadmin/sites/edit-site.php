<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>                                                                            
<?php NAtemplate::before_content('../', 'Create/Update site', true, ''); ?>
<?php

require_once(__DIR__ . '/../../impl/database/Sites.php');

if (isset($_GET) && isset($_GET['site-id'])) {
	$site_id = $_GET['site-id'];
} else {
	$site_id = null;
}

if ($site_id) {
	$sites = Sites::get();
	NAtemplate::check_errors();
	$site = $sites->get_site($site_id);
	$is_edit = true;
} else {
	$site = new Site('unique-id-of-your-site', 'Title of your site', '<p>Text (html) of your site.</p>', null, null, null, null, false, 0);
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
			<form action="actions/update-site.php" method="POST">
				<fieldset>
					<legend><h1><?= edit_or_new_text('Edit', 'Create') ?> site</h1></legend>
					<input type="hidden" name="current-site-id" value="<?= edit_or_new_text($site->get_id(), '') ?>">

					<label>Site id</label>
					<input type="text" name="site-id" value="<?= $site->get_id() ?>">
					<?php if (is_edit()) { ?>
					<span class="note">note: changing the site id will not cause to update links to this site in other sites!</span>
					<?php } ?>

					<label>Site title</label>
					<input type="text" name="title" value="<?= $site->get_title() ?>">
	
					<label>Visible</label>
					<input type="checkbox" name="visible" <?= ($site->is_visible() ? 'checked="true"' : '') ?>>
					<span class="note">(making site not visible will hide it from all menus and lists of sites)</span>

					<label>Text</label>
					<textarea name="content"><?= $site->get_content() ?></textarea>
				
					<div class="buttons-panel">
						<input type="submit" value="<?= edit_or_new_text('Update', 'Create') ?>">
						<input type="reset" value="Revert">
					</div>
				</fieldset>
			</form>		

<?php NAtemplate::after_content(); ?>
