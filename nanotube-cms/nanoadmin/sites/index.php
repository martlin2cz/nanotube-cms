<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>
<?php NAtemplate::before_document(true, '../'); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php NAtemplate::head('Sites'); ?>
	</head>
	<body>
		<?php NAtemplate::before_content(); ?>
			<h1>Sites</h1>
<?php 

require_once(__DIR__ . '/../../impl/database/Sites.php');

$sites = new Sites();

echo "<ol>\n";
foreach ($sites->all_sites() as $site) {
	echo "<li>" . $site->get_title() . "</li>\n";
}
echo "</ol>\n";

?>		
		<?php NAtemplate::after_content(); ?>
	</body>
</html>
