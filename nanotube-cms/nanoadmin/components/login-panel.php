<?php

require_once(__DIR__ . '/../../impl/LogingIn.php');

?>

<?php if (LogingIn::get()->is_logged_in()) { ?>
	<form action="actions/logout.php">
		<input type="submit" value="Log out">
	</form>
<?php } else { ?>
	<form action="actions/login.php">
		<input type="submit" value="Log in!">
	</form>
<?php } ?>
