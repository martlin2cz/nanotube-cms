<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('./', 'Instalation', false, ''); ?>
<?php

require_once(__DIR__ . '/../../impl/database/MysqlDatabase.php');

?>

	<h1>Instalation of nanotube-cms</h1>
	<p>The administration tool for <em>nanotube-cms</em>.</p>
<?php NAtemplate::after_content(); ?>
