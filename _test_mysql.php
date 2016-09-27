<html>
<pre>
<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/nanotube-cms/impl/database/MysqlDatabase.php');

// init
$config = new Config('Můj web');
$mysql = new MysqlDatabase($config);

// create table
$mysql->create_table('foo', '(bar INTEGER, baz CHAR(20), PRIMARY KEY (bar))');
echo "created table?\n";

// insert
$mysql->insert('foo', '(bar, baz)', '(42, 42)');
echo "inserted?\n";

// insert more
$mysql->insert('foo', '(bar, baz)', '(24, 24)');
$mysql->insert('foo', '(bar, baz)', '(99, 11)');
$mysql->insert('foo', '(bar, baz)', '(111, 222)');
echo "inserted more?\n";

// select 1
$r1 = $mysql->select('foo', '*', null, null); 
echo "selected 1? ";
print_r($r1);

// update
$r2 = $mysql->update('foo', 'baz = 333', ' bar = 111'); 
echo "selected 2? ";
print_r($r2);

// select 2
$r2 = $mysql->select('foo', '*', ' bar > 50', null); 
echo "selected 2? ";
print_r($r2);


// drop table
$mysql->drop_table('foo');
echo "dropped table?\n";


?>
</pre>
</html>
