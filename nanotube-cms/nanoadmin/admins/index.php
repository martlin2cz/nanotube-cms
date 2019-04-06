<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>                                                                            
<?php NAtemplate::before_content('../', 'Admins', true, ''); ?>
<?php 

require_once(__DIR__ . '/../impl/WebTools.php');
require_once(__DIR__ . '/../../impl/database/Admins.php');

$admins = Admins::get();
?>

<?php NAtemplate::check_errors(); ?>
	<table>
		<tr>
			<th>user name</th>
			<th>real name</th>
			<th>registered</th>
			<th>last login</th>
			<th></th>
		</tr>
		<?php foreach ($admins->all_admins() as $admin) { ?>
			<tr class="<?= ($admin->is_enabled() ? '' : 'inactive') ?>">
				<td><?= $admin->get_username() ?></td>
				<td><?= $admin->get_full_name() ?></td>
				<td><?= WebTools::format_date($admin->get_registered_at()) ?></td>
				<td><?= WebTools::format_date($admin->get_last_login_at()) ?></td>
				<td>
					<form action="edit-admin.php" method="GET">
						<input type="hidden" name="username" value="<?= $admin->get_username() ?>">
						<input type="submit" value="Edit">
					</form>
	
					<form action="actions/toggle-ability.php" method="GET">
						<input type="hidden" name="username" value="<?= $admin->get_username() ?>">
						<input type="submit" value="<?= ($admin->is_enabled() ? 'Disable' : 'Enable') ?>">
					</form>
				</td>
			</tr>
		<?php } ?>
	</table>
	
	<form action="edit-admin.php" method="GET">
		<input type="submit" value="Create new">
	</form>
<?php NAtemplate::after_content(); ?>
