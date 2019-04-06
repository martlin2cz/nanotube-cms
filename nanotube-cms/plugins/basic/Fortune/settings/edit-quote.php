<?php require_once(__DIR__ . '/../../../../nanoadmin/impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('../../../../nanoadmin/', "Edit quote", true, 
	'<script src="../js/scripts.js"></script>'); ?>

<?php
require_once(__DIR__ . '/../database/Quotes.php');
require_once(__DIR__ . '/../../../../nanoadmin/impl/WebTools.php');

// infer params
if (isset($_GET) && isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = null; 
}

$quotes = new Quotes();

if ($id != null) {
	$quote = $quotes->get_quote($id);
	if (!$quote) {
		Errors::add("Params error", "Quote with id $id does not exist.");
	}	
} else {
	$quote = null;
}

$is_edit = $quote != null;

if (!$quote) {
	$quote = new Quote(0, 'something', 'Someone', 'Something');
}

NAtemplate::check_errors();
?>

<form action="actions/save-quote.php" method="POST">
	<fieldset>
		<legend><h2>Modify/Create quote</h2></legend>
		<label>Dictionary</label>

		<input type="hidden" name="id" value="<?= $id ?>">

		<input type="text" name="dictionary-id" id="dictionary-id" value="<?= $quote->get_dictionary_id() ?>">
		<span class="note">Use
			<?php foreach ($quotes->get_all_dictionaries() as $dictionary) { ?>
				<a onclick="select_dictionary('<?= $dictionary ?>'); return false;" href="#"><?= $dictionary ?></a>,
			<?php } ?>
			or type custom and create new</span>

		<label>Author</label>
		<input type="text" name="author" value="<?= $quote->get_author() ?>">

		<label>Text</label>
		<input type="text" name="text" value="<?= $quote->get_text() ?>">

		<div class="buttons-panel">
			<input type="submit" value="Submit">		
			<input type="reset" value="Revert">
		</div>
	</fieldset>
</form>
<?php NAtemplate::after_content();
