<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>                                                                            
<?php NAtemplate::before_content('../', 'Sites', true, ''); ?>

<h1>Sites</h1>
<?php 
require_once(__DIR__ . '/../../impl/database/Sites.php');
require_once(__DIR__ . '/../impl/WebTools.php');

$sites = Sites::get();
?>

	<table>
		<tr>
			<th colspan="2">order</th>
			<th>ID</th>
			<th>title</th>
			<th>created</th>
			<th>last modified</th>
			<th colspan="2"></th>
		</tr>
		<?php foreach ($sites->all_sites() as $site) { ?>
		<tr class="<?= ($site->is_visible() ? '' : 'inactive') ?>">
				<td>
					<a href="actions/change-order.php?site-id=<?= $site->get_id() ?>&move=up" class="change-order-link">&uarr;</a>
					<a href="actions/change-order.php?site-id=<?= $site->get_id() ?>&move=down" class="change-order-link">&darr;</a>
				</td>
	
				<td><?= $site->get_order_num() ?></td>
				<td><?= $site->get_id() ?></td>
				<td><?= $site->get_title() ?></td>
				<td>
					<div>by <?= $site->get_created_by() ?></div>
					<div>at <?= WebTools::format_date($site->get_created_at()) ?><div>
				</td>
				<td>
					<div>by <?= $site->get_last_modified_by() ?></div>
					<div>at <?= WebTools::format_date($site->get_last_modified_at()) ?><div>
				</td>

				<td>
					<form action="edit-site.php" method="GET" class="inline">
						<input type="hidden" name="site-id" value="<?= $site->get_id() ?>">
						<input type="submit" value="Edit" />
					</form>
					<form action="actions/toggle-visibility.php" method="GET" class="inline">
						<input type="hidden" name="site-id" value="<?= $site->get_id() ?>">
						<input type="submit" value="<?= ($site->is_visible() ? 'Hide' : 'Show') ?>">
					</form>
				</td>
				<td><a href="<?= WebTools::make_link_to($site, "../../../") ?>" target="_blank">Open</a></td>

			</tr>
		<?php } ?>
	</table>

	<form>
		<button formaction="edit-site.php">Create new</button>
	<form>	
	
<?php NAtemplate::after_content(); ?>
