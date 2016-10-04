<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>                                                                            
<?php NAtemplate::before_content('../', 'Create/Update admin', true, ''); ?>
<?php

require_once(__DIR__ . '/../../impl/database/Admins.php');

if (isset($_GET) && isset($_GET['username'])) {
	$username = $_GET['username'];
} else {
	$username = null;
}

if ($username) {
	$admins = Admins::get();
	$admin = $admins->get_admin($username);
	NAtemplate::check_errors();
	$is_edit = true;
} else {
	$admin = new Admin('username', 'Full Name', null, null, true, 0, 0);
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
			<form action="actions/update-admin.php" method="POST">
				<fieldset>
					<legend><h1><?= edit_or_new_text('Update', 'Create') ?> admin</h1></legend>
					<input type="hidden" name="current-username" value="<?= edit_or_new_text($admin->get_username(), '') ?>">

					<label>Username</label>
					<input type="text" name="username" value="<?= $admin->get_username() ?>">
					<?php if (is_edit()) { ?>
					<span class="note">warning: changing the username may cause lots of problems, use with care!</span>
					<?php } ?>

					<label>Full name</label>
					<input type="text" name="full-name" value="<?= $admin->get_full_name() ?>">

					<label>Enabled</label>
					<input type="checkbox" name="enabled" <?= ($admin->is_enabled() ? 'checked="true"' : '') ?>>
					<span class="note">by disabling the admin you can ban access to the nanoadmin</span>

					<label>Password</label>
					<input type="password" name="password" value="">
					<?php if (is_edit()) { ?>
					<span class="note">leave blank if don't want to change</span>
					<?php } ?>


					<label>Password confirm</label>
					<input type="password" name="password-confirm" value="">

					<div class="buttons-panel">
						<input type="submit" value="<?= edit_or_new_text('Update', 'Create') ?>">
						<input type="reset" value="Revert">
					</div>
				</fieldset>
			</form>		

<?php NAtemplate::after_content(); ?>
