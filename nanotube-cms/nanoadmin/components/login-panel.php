<?php

require_once(__DIR__ . '/../../impl/LogingIn.php');
require_once(__DIR__ . '/../impl/NAtemplate.php');


?>

<?php if (LogingIn::get()->is_logged_in()) { ?>
	<form action="<?= NAtemplate::get_path_to_root() ?>actions/logout.php">
		<input type="submit" value="Log out">
	</form>
<?php } else { ?>
	<form action="<?= NAtemplate::get_path_to_root() ?>actions/login.php">
		<input type="submit" value="Log in!">
	</form>
<?php } ?>
