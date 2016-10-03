<?php require_once(__DIR__ . '/../../../../nanoadmin/impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('../../../../nanoadmin/', 'Fortune settings', true, ''); ?>
<?php
require_once(__DIR__ . '/../database/Quotes.php');

$quotes = new Quotes();

?>
<?php NAtemplate::check_errors() ?>
<table>
	<tr>
		<th>Dictionary id</th>
		<th>Author</th>
		<th>Text</th>
		<th></th>
	</tr>
	<?php foreach ($quotes->all_quotes(null) as $dict) { ?>
		<?php foreach ($dict as $quote) { ?>
		<tr>
			<td><?= $quote->get_dictionary_id() ?></td>			
			<td><?= $quote->get_author() ?></td>			
			<td><?= $quote->get_text() ?></td>
			<td>...</td>			
		</tr>
	<?php } ?>
	<?php } ?>

</table>
<?php NAtemplate::after_content(); ?>
