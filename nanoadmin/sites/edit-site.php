<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>                                                                            
<?php NAtemplate::before_content('../', 'Create/Update site', true, 
	'<script type="text/javascript" src="js/scripts.js"></script>'
); ?>
<?php

require_once(__DIR__ . '/../../impl/database/Sites.php');
require_once(__DIR__ . '/../../impl/Plugins.php');


if (isset($_GET) && isset($_GET['site-id'])) {
	$site_id = $_GET['site-id'];
} else {
	$site_id = null;
}

if ($site_id) {
	$sites = Sites::get();
	$site = $sites->get_site($site_id);
	if (!$site) {
		Errors::add("Params error", "Site $site_id does not exist.", false);
		$site = new Site('', '', '', null, null, null, null, false,  0);
	}
	NAtemplate::check_errors();

	$is_edit = true;
} else {
	$site = new Site('unique-id-of-your-site', 'Title of your site', '<p>Text (html) of your site.</p>', null, null, null, null, false, 0);
	$is_edit = false;
}

function is_edit() {
	global $is_edit;
	return $is_edit;
}

function edit_or_new_text($edit_text, $new_text) {
	if (is_edit()) {
		return $edit_text;
	} else {
		return $new_text;
	}
}

?>
			<form action="actions/update-site.php" method="POST">
				<fieldset>
					<legend><h1><?= edit_or_new_text('Edit', 'Create') ?> site</h1></legend>
					<input type="hidden" name="current-site-id" value="<?= edit_or_new_text($site->get_id(), '') ?>">

					<label>Site id</label>
					<input type="text" name="site-id" value="<?= $site->get_id() ?>">
					<?php if (is_edit()) { ?>
					<span class="note">note: changing the site id will not cause to update links to this site in other sites!</span>
					<?php } ?>

					<label>Site title</label>
					<input type="text" name="title" value="<?= $site->get_title() ?>">
	
					<label>Visible</label>
					<input type="checkbox" name="visible" <?= ($site->is_visible() ? 'checked="true"' : '') ?>>
					<span class="note">(making site not visible will hide it from all menus and lists of sites)</span>

					<label>Text (HTML)</label>
					<textarea name="content" id="content-textarea"><?= $site->get_content() ?></textarea>
				
					<div class="buttons-panel">
						<input type="submit" value="<?= edit_or_new_text('Update', 'Create') ?>" onclick="doSave(this)">
						<input type="reset" value="Revert">
						<input type="submit" value="Preview" formaction="actions/preview-site.php" onclick="doPreview(this)">
					</div>
				</fieldset>
			</form>		

	<h2>HTML shorthand</h2>
	<section>
		<p>Line wraps and empty lines are ignored. Structure text into paragraphs by wrapping by <code>&lt;p&gt;...&lt;/p&gt;</code>. Do not use <code>&lt;br&gt;</code> to wrap lines! Click to one to clone into editor.</p>
		<pre class="html-shorthand-item" onclick="toEditor(this)">&lt;em&gt;<em>emphatise by italics</em>&lt;/em&gt;</pre>
		<pre class="html-shorthand-item" onclick="toEditor(this)">&lt;strong&gt;<strong>empthatise by bold font</strong>&lt;/strong&gt;</pre>
		<pre class="html-shorthand-item" onclick="toEditor(this)">&lt;img src="<em>url of image</em>" alt="<em>description</em>"&gt;</pre>
		<pre class="html-shorthand-item" onclick="toEditor(this)">&lt;a href="<em>url adress</em>"&gt;<a href="#">text of link</a>&lt;/a&gt;</pre>
		<pre class="html-shorthand-item" onclick="toEditor(this)">&lt;p&gt;
Some really very long text
inside of the paragraph.
&lt;/p&gt;</pre>
		<pre class="html-shorthand-item" onclick="toEditor(this)">&lt;div class="centered"&gt;
&larr; This is centered &rarr;
&lt;/div&gt;</pre>
	
		<pre class="html-shorthand-item" onclick="toEditor(this)">&lt;ul&gt;
  &lt;li&gt; &bull; first bullet &lt;/li&gt;
  &lt;li&gt; &bull; second bullet &lt;/li&gt;
&lt;/ul&gt;</pre>
		<pre class="html-shorthand-item" onclick="toEditor(this)">&lt;ol&gt;
  &lt;li&gt; 1. bullet &lt;/li&gt;
  &lt;li&gt; 2. bullet &lt;/li&gt;
&lt;/ol&gt;</pre>
		<pre class="html-shorthand-item" onclick="toEditor(this)">&lt;table&gt;
  &lt;tr&gt;  &lt;td&gt; <strong>cell A1</strong> &lt;/td&gt;  &lt;td&gt; <strong>cell B1</strong> &lt;/td&gt;  &lt;/tr&gt;
  &lt;tr&gt;  &lt;td&gt; <strong>cell A2</strong> &lt;/td&gt;  &lt;td&gt; <strong>cell B2</strong> &lt;/td&gt;  &lt;/tr&gt;
&lt;/table&gt;</pre>
	<p>Warning: concrete design of given HTML constructs depends on the template settings.</p>


	
	</section>
				
<?php
$plugins = Plugins::get();

NAtemplate::check_errors();
?>
				<h2>Avaible plugins</h2>
				<table class="with-no-cells-border">
					<?php foreach ($plugins->all_plugins() as $plugin) { ?>
					<tr>
						<td><?= $plugin->get_name() ?></td>
						<td><?= $plugin->get_usage() ?></td>
						<td><a href="../plugins/plugin-info.php?id=<?= $plugin->get_id() ?>" target="_blank">More info</a></td>
					</tr>
					<?php } ?>
				</table>

<?php NAtemplate::after_content(); ?>
