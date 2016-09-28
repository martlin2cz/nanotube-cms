<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../impl/LogingIn.php');
require_once(__DIR__ . '/../../impl/Tools.php');

class NAtemplate {
	
	static private $path_to_root;

	static public function get_path_to_root() {
		return self::$path_to_root;
	}

	static public function before_content($path_to_root, $title, $require_login, $additional_heads) {
		self::$path_to_root = $path_to_root;

		if (LogingIn::get()->is_not_logged() && $require_login) {
			Tools::redirect_to_relative(self::$path_to_root);
		}

		self::put_before_content_html($title, $require_login, $additional_heads);
	}

	static private function put_before_content_html($title, $require_login, $additional_heads) { ?><!DOCTYPE html>
	<html>
		<head>	
			<title><?= $title ?> | nanoadmin</title>
			<link rel="stylesheet" href="<?= self::$path_to_root ?>css/styles.css" type="text/css" />	
		</head>
		<body>
			<header>
				<section>
					<h2>nanoadmin</h2>
				</section>
			
				<?php if (LogingIn::get()->is_logged_in()) { ?>		
				<nav>
<!-- TODO make ol and li s -->
				<a href="<?= self::$path_to_root ?>web-config/">Web config</a>
				<a href="<?= self::$path_to_root ?>sites/">Sites</a>
				<a href="<?= self::$path_to_root ?>plugins/">Plugins</a>
				<a href="<?= self::$path_to_root ?>admins/">Admins</a>
				</nav>
				<?php } ?>
			
				<section>
					<?php require_once(__DIR__ . '/../components/login-panel.php'); ?>
				<section>
			</header>	
		<main>
	<?php }

	static public function after_content() {
		self::$path_to_root = null;
		
		self::put_after_content_html();
	}

	static private function put_after_content_html() { ?>
		</main>
		<footer>
			nanoadmin powered by nanotube-cms.
		</footer>
		</body>
	</html>

<?php }
 
}

?>
