<?php require_once(__DIR__ . '/../../../../nanoadmin/impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('../../../../nanoadmin/', 'Events list', true, ''); ?>
<?php
require_once(__DIR__ . '/../database/Events.php');
require_once(__DIR__ . '/../../../../nanoadmin/impl/WebTools.php');

$events = new Events();

?>
<?php NAtemplate::check_errors() ?>

<table>
	<tr>
		<th>Date</th>
		<th>When</th>
		<th>Title</th>
		<th>Added</th>
		<th></th>
	</tr>
	<?php foreach ($events->all_events(false) as $event) { ?>
		<tr>
			<td><?= WebTools::format_only_date($event->get_date()) ?></td>			
			<td><?= $event->get_when() ?></td>			
			<td><?= $event->get_title() ?></td>
			<td>
				<div>by <?= $event->get_added_by() ?></div>
				<div>at <?= WebTools::format_date($event->get_added_at()) ?></div>
			</td>
			<td>
				<form method="GET">
					<input type="hidden" name="id" value="<?= $event->get_id() ?>">
					<input type="submit" value="Edit" formaction="edit-event.php">
					<input type="submit" value="Delete" formaction="actions/delete-event.php" onclick="return confirm('Are you sure?');">
				</form>
			</td>			
		</tr>
	<?php } ?>
</table>
<form method="POST">
	<input type="submit" value="Create new" formaction="edit-event.php">
</form>
	


<?php NAtemplate::after_content(); ?>
