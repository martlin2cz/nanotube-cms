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
			
				<?php if (!is_null($require_login)) { ?>
					<section>
						<?php require_once(__DIR__ . '/../components/login-panel.php'); ?>
					</section>
				<?php } ?>
			</header>	
		<main>
		<?php /* self::check_errors(); */ ?>
	<?php }

	static public function after_content() {
		self::$path_to_root = null;
		
		self::put_after_content_html();
	}

	static private function put_after_content_html() { ?>
		<?php /* self::check_errors(); */ ?>
		<button onclick="history.back()">Back</button>
		</main>
		<footer>
			nanoadmin powered by nanotube-cms.
		</footer>
		</body>
	</html>

<?php }

	static public function check_errors() {
		if (Errors::is_some_error()) {
			$errors = Errors::flush_errors();
			foreach ($errors as $error) {
				self::do_error($error);
			}
		}
	}

	static public function do_error($error) { ?>
		<article class="panel <?= (($error->is_critical()) ? 'critical-error' : 'failure') ?>">
			<h2><?= $error->get_title() ?></h2>
			<p><?= $error->get_message() ?></p>
		</article>	
	<?php }

	static public function do_success($text) { ?>
		<article class="panel success">
			<h2>Okay</h2>
			<p><?= $text ?></p>
		</article>	
	<?php }

}

?>
