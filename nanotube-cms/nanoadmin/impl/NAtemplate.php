<?php

//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/LogingIn.php');

class NAtemplate {

	static public function before_document($redirect_unlogged) {
		if (LogingIn::get()->is_not_logged() && $redirect_unlogged) {
			//TODO
			echo "Will redirect to main admin page, TODO ...";
		}
	}

	static public function head($title) { ?>
		<title><?= $title ?> | nanoadmin</title>	
		<link rel="stylesheet" href="css/styles.css" type="text/css" />	
	<?php }


	static public function before_content() { ?>
		<header>
			<section>
				<h2>nanoadmin</h2>
			</section>
			<section>
				<?php require_once(__DIR__ . '/../components/login-panel.php'); ?>
			<section>
		</header>	
		<main>
	<?php }

	static public function after_content() { ?>
		</main>
	<?php }
}

?>
