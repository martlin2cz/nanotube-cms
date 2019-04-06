<?php require_once(__DIR__ . '/../../../../nanoadmin/impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('../../../../nanoadmin/', "Edit event", true, ''); ?>

<?php
require_once(__DIR__ . '/../database/Events.php');
require_once(__DIR__ . '/../../../../nanoadmin/impl/WebTools.php');

// infer params
if (isset($_GET) && isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = null; 
}

$events = new Events();

if ($id != null) {
	$event = $events->get_event($id);
	if (!$event) {
		Errors::add("Params error", "Event with id $id does not exist.");
	}	
} else {
	$event = null;
}

$is_edit = $event != null;

if (!$event) {
	$event = new Event(0, time(), 'Now', 'MegaEvent', 'It will be awesome!', NANOADMIN_USERNAME, time());
}

NAtemplate::check_errors();
?>

<form action="actions/save-event.php" method="POST">
	<fieldset>
		<legend><h2>Modify/Create event</h2></legend>
		<input type="hidden" name="id" value="<?= $id ?>">

		<label>Date</label>
		<input type="date" name="date" value="<?= WebTools::format_date_to_input($event->get_date()) ?>">

		<label>When &amp; where</label>
		<input type="text" name="when" value="<?= $event->get_when() ?>">

		<label>Title</label>
		<input type="text" name="title" value="<?= $event->get_title() ?>">

		<label>Description</label>
		<textarea name="description"><?= $event->get_description() ?></textarea>

		<div class="buttons-panel">
			<input type="submit" value="Submit">		
			<input type="reset" value="Revert">
		</div>
	</fieldset>
</form>
<?php NAtemplate::after_content();
