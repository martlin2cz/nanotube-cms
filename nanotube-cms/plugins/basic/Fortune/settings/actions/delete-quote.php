<?php require_once(__DIR__ . '/../../../../../nanoadmin/impl/ActionTemplate.php'); ?>
<?php ActionTemplate::before_start('../../../../../nanoadmin/', true); ?>

<?php
require_once(__DIR__ . '/../../../../../nanoadmin/impl/WebTools.php');
require_once(__DIR__ . '/../../database/Quotes.php');

// infer params
$id = WebTools::require_getted_id('id', false);

ActionTemplate::check_errors();

// load/create data object
$quotes = new Quotes();
$quote = $quotes->get_quote($id);
if (!$quote) {
	Erorrs::add("Params error", "Quote with id $id does not exist.", false);
}

ActionTemplate::check_errors();

//save
$succ = $quotes->remove_quote($quote);

ActionTemplate::check_errors();
ActionTemplate::success('../');
?>
