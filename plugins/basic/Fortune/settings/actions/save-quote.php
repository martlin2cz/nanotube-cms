<?php require_once(__DIR__ . '/../../../../../nanoadmin/impl/ActionTemplate.php'); ?>
<?php ActionTemplate::before_start('../../../../../nanoadmin/', true); ?>

<?php
require_once(__DIR__ . '/../../../../../nanoadmin/impl/WebTools.php');
require_once(__DIR__ . '/../../database/Quotes.php');

// infer params
$id = WebTools::require_posted_id('id', true);
$dictionary_id = WebTools::require_posted_id('dictionary-id', false);
$author = WebTools::require_posted_string('author', true);
$text = WebTools::require_posted_string('text', false);

// aditional params and check
$is_edit = $id != '';

ActionTemplate::check_errors();

// load/create data object
$quotes = new Quotes();
if ($is_edit) {
	$quote = $quotes->get_quote($id);
	if (!$quote) {
		Erorrs::add("Params error", "Quote with id $id does not exist.", false);
	}
} else {
	$quote = new Quote(0, "", "", "");
}

ActionTemplate::check_errors();

//modify data object
$quote->set_dictionary_id($dictionary_id);
$quote->set_author($author);
$quote->set_text($text);

//save
if ($is_edit) {
	$succ = $quotes->update_quote($quote);
} else {
	$succ = $quotes->insert_quote($quote);
}

ActionTemplate::check_errors();
ActionTemplate::success('../');
?>
