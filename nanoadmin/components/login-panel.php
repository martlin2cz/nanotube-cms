<?php

require_once(__DIR__ . '/../../impl/LogingIn.php');
require_once(__DIR__ . '/../impl/NAtemplate.php');


?>

<?php if (LogingIn::get()->is_logged_in()) { ?>
	<form action="<?= NAtemplate::get_path_to_root() ?>actions/logout.php" method="POST">
		<fieldset>	
			<output title="<?= LogingIn::get()->logged_admin()->get_full_name() ?>">
				<?= LogingIn::get()->logged_admin()->get_username() ?>
			</output>
			<input type="submit" value="Log out">
		</fieldset>
	</form>
<?php } else { ?>
	<form action="<?= NAtemplate::get_path_to_root() ?>actions/login.php" method="POST">
		<fieldset>
			<label>Log in:</label>
			<input type="text" name="username" placeholder="username">
			<input type="password" name="password" placeholder="password">
			<input type="submit" value="Log in!">
		</fieldset>
	</form>
<?php } ?>
