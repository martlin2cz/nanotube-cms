<html><body>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


echo "loading...";

require_once("nanotube-cms/impl/database/Sites.php");

echo "loaded!<br>\n";

$sites = new Sites();

foreach ($sites->all_sites() as $site) {
	echo "<h1>" . $site->get_title() . " (" . $site->get_id() . ")</h1>\n";
	echo "<div>" . $site->get_content() . "</div>\n";
}


?>
</body></html>
