<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>
<?php NAtemplate::before_document(true, '../'); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php NAtemplate::head('Web config'); ?>
	</head>
	<body>
		<?php NAtemplate::before_content(); ?>
			<h1>Web config</h1>
<?php 

require_once(__DIR__ . '/../../impl/dataobj/Config.php');

$config = new Config('TODO');
echo "<pre>";
print_r($config);
echo "</pre>";
		
		?>		
		<?php NAtemplate::after_content(); ?>
	</body>
</html>
