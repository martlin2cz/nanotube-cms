<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('../', 'Plugins', true, ''); ?>
<?php
require_once(__DIR__ . '/../../impl/Plugins.php');

$plugins = new Plugins();

?>
<?php NAtemplate::check_errors() ?>
<table class="with-no-cells-border">
	<tr>
		<th>Name</th>
		<th>Status</th>
		<th></th>
	</tr>
	<?php foreach ($plugins->all_plugins() as $id => $plugin) { ?>
		<tr>
			<td title="id = <?= $plugin->get_id() ?>, category = <?= $plugin->get_category() ?>"><?= $plugin->get_name() ?></td>
			<td>
				<?= $plugin->get_status() ?>
				<?php if ($plugin->get_status() == PLUGIN_STATUS_UNINSTALLED) { ?>
					<form action="actions/install.php" method="GET">
						<input type="hidden" name="plugin-id" value="<?= $plugin->get_id() ?>">
						<input type="submit" value="Install">
					</form>
				<?php } else if ($plugin->get_status() == PLUGIN_STATUS_INSTALLED) { ?>
					<form action="actions/uninstall.php" method="GET">
						<input type="hidden" name="plugin-id" value="<?= $plugin->get_id() ?>">
						<input type="submit" value="Uninstall" onclick="return confirm('Are you sure?')">
					</form>
				<?php } else if ($plugin->get_status() == PLUGIN_STATUS_OK) { ?>
					<!-- plugin is ok -->
				<?php } else { ?>
					<span class="note">unknown?</span>
				<?php } ?>
			</td>	
			<td>
				<a href="plugin-info.php?id=<?= $plugin->get_id() ?>">More info</a>
				<?php if ($plugin->has_settings()) { ?>
					<a href="../../plugins/<?= $plugin->get_settings_path() ?>">Settings</a>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td colspan="3" class="with-bottom-border">
			<?= $plugin->get_description(); ?>
			</td>
		</tr>
	<?php } ?>
</table>
<?php NAtemplate::after_content(); ?>
