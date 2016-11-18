<?php require_once(__DIR__ . '/../../../../../nanoadmin/impl/ActionTemplate.php'); ?>
<?php ActionTemplate::before_start('../../../../../nanoadmin/', true); ?>

<?php
require_once(__DIR__ . '/../../../../../nanoadmin/impl/WebTools.php');
require_once(__DIR__ . '/../../database/Events.php');

// infer params
$id = WebTools::require_posted_id('id', true);
$date = WebTools::require_posted_date('date', false);
$when = WebTools::require_posted_string('when', true);
$title = WebTools::require_posted_string('title', true);
$description = WebTools::require_posted_string('description', true);

// aditional params and check
$is_edit = $id != '';

ActionTemplate::check_errors();

// load/create data object
$events = new Events();
if ($is_edit) {
	$event = $events->get_event($id);
	if (!$event) {
		Erorrs::add("Params error", "Event with id $id does not exist.", false);
	}
} else {
	$event = new Event(0, NULL, "", "", "", time(), NANOADMIN_USERNAME);
}

ActionTemplate::check_errors();

//modify data object
$event->set_date($date);
$event->set_when($when);
$event->set_title($title);
$event->set_description($description);

//save
if ($is_edit) {
	$succ = $events->update_event($event);
} else {
	$succ = $events->insert_event($event);
}

ActionTemplate::check_errors();
ActionTemplate::success('../');
?>
