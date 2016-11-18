<?php require_once(__DIR__ . '/../../../../../nanoadmin/impl/ActionTemplate.php'); ?>
<?php ActionTemplate::before_start('../../../../../nanoadmin/', true); ?>

<?php
require_once(__DIR__ . '/../../../../../nanoadmin/impl/WebTools.php');
require_once(__DIR__ . '/../../database/Events.php');

// infer params
$id = WebTools::require_getted_id('id', false);

ActionTemplate::check_errors();

// load/create data object
$events = new Events();
$event = $events->get_event($id);
if (!$event) {
	Erorrs::add("Params error", "Event with id $id does not exist.", false);
}

ActionTemplate::check_errors();

//save
$succ = $events->remove_event($event);

ActionTemplate::check_errors();
ActionTemplate::success('../');
?>
