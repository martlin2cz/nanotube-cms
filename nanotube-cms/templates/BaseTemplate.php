<?php

class BaseTemplate {

	public function __construct() {
	}

	public function render() { ?><!DOCTYPE>
<html>
	<head>
		<!--TODO -->
		<title><?php $this->render_title(); ?></title>
	</head>
	<body>
	<?php $this->render_body(); ?>
	</body>
</html>
<?php }

	public function render_title() {
		echo "Base page layout";
	}

	public function render_body() {
		echo "Hello!";	//TODO here
	}
}

?>


