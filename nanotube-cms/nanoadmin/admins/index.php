<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>                                                                            
<?php NAtemplate::before_content('../', 'Admins', true, ''); ?>

<h1>Admins</h1>
<?php 
require_once(__DIR__ . '/../../impl/database/Admins.php');

$admins = Admins::get();
?>

	<table>
		<tr>
			<th>user name</th>
			<th>name</th>

		</tr>
		<?php foreach ($admins->all_admins() as $admin) { ?>
			<tr>
				<td><?= $admin->get_username() ?></td>
				<td><?= $admin->get_full_name() ?></td>

			</tr>
		<?php } ?>
	</table>
	
	<a href="edit-admin.php">Create new</a>
	
<?php NAtemplate::after_content(); ?>
