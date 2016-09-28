<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>
<?php NAtemplate::before_content('../', 'Plugins', true, ''); ?>
<?php
require_once(__DIR__ . '/../../impl/Plugins.php');

$plugins = new Plugins();

echo "<p>Loading plugins ...</p>\n";
$plugins->load_all_plugins();
echo "<p>Plugins loaded!</p>\n";

?>		
<?php NAtemplate::after_content(); ?>
