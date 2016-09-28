<html>
<pre>
<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/nanotube-cms/impl/database/FileDatabase.php');

// init
$db = new FileDatabase('foo.php');

// save
 $db->save('<?php global $bar; $bar = 42; ?>'); 
echo "saved? \n";

// load
$db->load();
global $bar;
echo "loaded? $bar\n";

// save object #1
require_once(__DIR__ . '/nanotube-cms/impl/dataobj/Error.php');
$db->save_constructored("Error", "error", Array("Test Failure", "Test failed, yea", false));
echo "saved #2? \n";

$db->load();
global $error;
echo "loaded #2? $error\n";

// save object #2
require_once(__DIR__ . '/nanotube-cms/impl/dataobj/Config.php');
$db->save_settered("Config", "config", Array("web_title" => "Můj web"));
echo "saved #3? \n";

$db->load();
global $config;
echo "loaded #3? $config\n";





// remove
//$db->remove();
echo "removed? \n";


?>
</pre>
</html>
