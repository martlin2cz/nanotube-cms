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
?>

	<table>
		<tr>
			<th>order</th>
			<th>ID</th>
			<th>title</th>
			<th colspan="2">created</th>
			<th colspan="2">last modified</th>
			<th colspan="3"></th>
		</tr>
		<?php foreach ($sites->all_sites() as $site) { ?>
			<tr>
				<td>(order number)</td>
				<td><?= $site->get_id() ?></td>
				<td><?= $site->get_title() ?></td>
				<td><?= $site->get_created_by() ?></td>
				<td><?= $site->get_created_at() ?></td>
				<td><?= $site->get_last_modified_by() ?></td>
				<td><?= $site->get_last_modified_at() ?></td>

				<td><a href="TODOOOO">show</a></td>
				<td><a href="edit-site.php?site-id=<?= $site->get_id() ?>">edit</a></td>
				<td><a href="delete-site.php?site-id=<?= $site->get_id() ?>">show/hide</a></td>
	
			</tr>
		<?php } ?>
	</table>
	
	<a href="edit-site.php">Create new</a>
	
	<?php NAtemplate::after_content(); ?>
	</body>
</html>
