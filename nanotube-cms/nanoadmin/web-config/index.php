<?php require_once(__DIR__ . '/../impl/NAtemplate.php'); ?>                                                                            
<?php NAtemplate::before_content('../', 'Web config', true, ''); ?>
<h1>Web config</h1>
<?php 

require_once(__DIR__ . '/../../impl/dataobj/Config.php');

$config = new Config('TODO');
echo "<pre>";
print_r($config);
echo "</pre>";
		
?>		
<?php NAtemplate::after_content(); ?>
