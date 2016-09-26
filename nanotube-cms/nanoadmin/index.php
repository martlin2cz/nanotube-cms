<?php require_once(__DIR__ . '/impl/NAtemplate.php'); ?>
<?php NAtemplate::before_document(false, ''); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php NAtemplate::head('nanoadmin'); ?>
	</head>
	<body>
		<?php NAtemplate::before_content(); ?>
			<h1>nanoadmin</h1>
			<p>The administration tool for <em>nanotube-cms</em>.</p>
		<?php NAtemplate::after_content(); ?>
	</body>
</html>
