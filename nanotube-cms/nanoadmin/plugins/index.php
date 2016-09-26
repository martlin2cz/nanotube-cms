<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>
<?php NAtemplate::before_document(true, '../'); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php NAtemplate::head('Plugins'); ?>
	</head>
	<body>
		<?php NAtemplate::before_content(); ?>
			<h1>Plugins</h1>
<?php 

require_once(__DIR__ . '/../../impl/Plugins.php');

$plugins = new Plugins();

echo "<p>Loading plugins ...</p>\n";
$plugins->load_all_plugins();
echo "<p>Plugins loaded!</p>\n";
		
		?>		
		<?php NAtemplate::after_content(); ?>
	</body>
</html>
