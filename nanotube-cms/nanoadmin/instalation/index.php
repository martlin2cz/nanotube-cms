<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('../', 'Instalation', true, ''); ?>
<?php
require_once(__DIR__ . '/../../impl/database/Configs.php');
require_once(__DIR__ . '/../../impl/database/MysqlDatabase.php');
require_once(__DIR__ . '/../../impl/database/Sites.php');
require_once(__DIR__ . '/../../impl/database/Admins.php');

$configs = Configs::get();
$config = $configs->get_config(); 

$is_part1_ok = 
	!is_null($config->get_web_title()) && 
	!is_null($config->get_web_description()) && 
	!is_null($config->get_web_keywords());

$is_part2_ok = 
	!is_null($config->get_mysql_server()) && 
	!is_null($config->get_mysql_database()) &&
	!is_null($config->get_mysql_user()) &&
	!is_null($config->get_mysql_password());

if ($is_part2_ok) {
	$db = new MysqlDatabase($config);

	$is_db_test_ok = $db->test();
} else {
	$is_db_test_ok = null;
}

if ($is_part2_ok && $is_db_test_ok) {
	$is_part3_ok = 
		Admins::get()->all_admins_real() && 
		Sites::get()->all_sites_real();
} else {
	$is_part3_ok = null;
}

Errors::clear_errors();	//yeah, here are just annoying
?>

<p>The instalation needs three steps. Firstly you have to make up configuration file. Then you specify database connection parameters. Finally you connect do database and do the database stuff.</p>

<form action="actions/save-basic-config.php" method="POST">
<fieldset>
	<legend><h2>1) Set up an config file</h2></legend>

	<label>Web title</label>
	<input type="text" name="web-title" placeholder="My web" value="<?= $config->get_web_title() ?>">
	
	<label>Description</label>
	<input type="text" name="web-description" placeholder="This is my personal web" value="<?= $config->get_web_description() ?>">

	<label>Some keywords</label>
	<input type="text" name="web-keywords" placeholder="personal, web, websites" value="<?= $config->get_web_keywords() ?>">

	<label>Nanoadmin password</label>
	<input type="password" name="nanoadmin-password" placeholder="<?= ($is_part1_ok ? 'enter something to change' : 'type the password') ?>" value="">

	<label>Confirm password</label>
	<input type="password" name="confirm-password" placeholder="confirm the password" value="">


	<div class="buttons-panel">	
		<input type="submit" value="Save">
		<input type="reset" value="Revert">
	</div>

	<?php if ($is_part1_ok) { ?>
		<?php NAtemplate::do_success("<p>Config file created and saved. You can still modify the data above and/or continue.</p>"); ?>	
	<?php } ?>

</fieldset>
</form>

<form action="actions/save-mysql-config.php" method="POST">
<fieldset>
	<legend><h2>2) Set up MySQL database connection</h2></legend>

	<label>Database server</label>
	<input type="text" name="server" placeholder="something.com" value="<?= $config->get_mysql_server() ?>">
	
	<label>Database name</label>
	<input type="text" name="name" placeholder="my_nano_db" value="<?= $config->get_mysql_database() ?>">

	<label>User name</label>
	<input type="text" name="username" placeholder="my_nano_db_user" value="<?= $config->get_mysql_user() ?>">

	<label>Password</label>
	<input type="password" name="password" placeholder="my_nano_password" value="<?= $config->get_mysql_password() ?>">

	<div class="buttons-panel">	
		<input type="submit" value="Save">
		<input type="reset" value="Revert">
	</div>

	<?php if ($is_part2_ok) { ?>
		<?php NAtemplate::do_success("<p>Database config saved. You can still modify the data above and/or continue.</p>"); ?>	
		<?php if ($is_db_test_ok) { ?>
			<?php NAtemplate::do_success("<p>Connected to database! Now you can continue.</p>"); ?>	
		<?php } else { ?>
			<?php NAtemplate::do_error(new NanoError("NanoError", "<p>Cannot connect to the database! Make sure you entered corect configuration and have sufficient permissions. Try direct connect (using <code>mysql</code>).</p>", true)); ?>	
		<?php } ?>	
	<?php } ?>
</fieldset>
</form>

<form action="actions/create-database.php" method="POST">
<fieldset>
	<legend><h2>3) Create database</h2></legend>
	<p>Once you saved config file and checked connection to the database, you can instal <em>nanotube-cms</em>'s database.
	<div class="buttons-panel">	
	<input type="submit" value="Create database" <?= ($is_part1_ok && $is_part2_ok) ? '' : 'disabled="true"' ?>>
	</div>

	<?php if ($is_part3_ok === true) { ?>
		<?php NAtemplate::do_success("<p>Database seems installed! Try to open you web now.</p>"); ?>	
	<?php } else if ($is_part3_ok === false) { ?>
		<?php NAtemplate::do_error(new NanoError("NanoError", "<p>Database creation somehow failed. I'm sorry..</p>", true)); ?>	
	<?php } ?>
</fieldset>
</form>

<fieldset>
	<legend><h2>4) Complete the instalation</h2></legend>
	<p>The web may be ready now, but please <a href="../../../../" target="_blank">check it</a>. If so, <a href="../admins/edit-admin.php" target="_blank">create your admin account</a>. After that log out and relog to that account. Then you could edit the <a href="../sites" target="_blank">sites</a> and/or install the <a href="../plugins" target="_blank">plugins</a>. Also, you may update the template. Happy coding!</p>
</fieldset>
<?php NAtemplate::after_content(); ?>
