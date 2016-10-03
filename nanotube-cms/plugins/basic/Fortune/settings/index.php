<?php require_once(__DIR__ . '/../../../../nanoadmin/impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('../../../../nanoadmin/', 'Fortune settings - quotes list', true, ''); ?>
<?php
require_once(__DIR__ . '/../database/Quotes.php');

$quotes = new Quotes();

if (isset($_GET) && isset($_GET['dictionary-id'])) {
	$dictionary_id = $_GET['dictionary-id'];
	if ($dictionary_id == '') {
		$dictionary_id = null;
	}
} else {
	$dictionary_id = null;
}

?>
<?php NAtemplate::check_errors() ?>


<form action="." method="GET">
	<fieldset>
		<label>Show only quotes from dictionary</label>
		<select name="dictionary-id">
			<option value="">all dictionaries</option>
			<?php foreach ($quotes->get_all_dictionaries() as $dictionary) { ?>
				<option value="<?= $dictionary ?>" <?= ($dictionary == $dictionary_id ? 'selected="true"' : '') ?>><?= $dictionary ?></option>
			<?php } ?>
		</select>
		<input type="submit" value="Show">
	</fieldset>
</form>
<table>
	<tr>
		<th>Dictionary id</th>
		<th>Author</th>
		<th>Text</th>
		<th></th>
	</tr>
	<?php foreach ($quotes->all_quotes($dictionary_id) as $quote) { ?>
		<tr>
			<td><?= $quote->get_dictionary_id() ?></td>			
			<td><?= $quote->get_author() ?></td>			
			<td><?= $quote->get_text() ?></td>
			<td>
				<form method="GET">
					<input type="hidden" name="id" value="<?= $quote->get_id() ?>">
					<input type="submit" value="Edit" formaction="edit-quote.php">
					<input type="submit" value="Delete" formaction="actions/delete-quote.php" onclick="return confirm('Are you sure?');">
				</form>
			</td>			
		</tr>
	<?php } ?>
</table>
<form method="POST">
	<input type="submit" value="Create new" formaction="edit-quote.php">
</form>
	


<?php NAtemplate::after_content(); ?>
