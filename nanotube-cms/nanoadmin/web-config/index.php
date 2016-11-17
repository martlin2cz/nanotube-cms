<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>                                                                            
<?php NAtemplate::before_content('../', 'Web configuraton', true, ''); ?>
<?php

require_once(__DIR__ . '/../../impl/database/Configs.php');

$configs = Configs::get();
$config = $configs->get_config();

?>
<?php NAtemplate::check_errors(); ?>
			<form action="actions/update-config.php" method="POST">
				<fieldset>
					<legend><h2>Basic config</h2></legend>

					<label>Web title</label>
					<input type="text" name="web-title" value="<?= $config->get_web_title() ?>">

					<label>Web description</label>
					<input type="text" name="web-description" value="<?= $config->get_web_description() ?>">
	
					<label>Web keywords</label>
					<input type="text" name="web-keywords" value="<?= $config->get_web_keywords() ?>">
				</fieldset>


				<fieldset>
					<legend><h2>Nanoadmin</h2></legend>

					<label>nanoadmin's password</label>
					<input type="password" name="na-password">
					<span class="note">leave empty if don't want to change</span>

					<label>password confirm</label>
					<input type="password" name="na-password-confirm">

				</fieldset>

				<fieldset>
					<legend><h2>Database config</h2></legend>

					<label>Database server</label>
					<input type="text" name="mysql-server" value="<?= $config->get_mysql_server() ?>" disabled="">
					<span class="note">to change the database credentials use the <a href="../instalation">instalation</a> page</span>

					<label>Database name</label>
					<input type="text" name="mysql-database" value="<?= $config->get_mysql_database() ?>" disabled="">
	
					<label>Database user</label>
					<input type="text" name="mysql-user" value="<?= $config->get_mysql_user() ?>" disabled="">
	
					<label>Database password</label>
					<input type="password" name="mysql-password" value="U MAD BRO?! I DUNT TELL YA" disabled="">
					<span class="note">this is not the real password</span>
				</fieldset>

					<div class="buttons-panel">
						<input type="submit" value="Save">
						<input type="reset" value="Revert">
					</div>
			</form>		

<?php NAtemplate::after_content(); ?>
