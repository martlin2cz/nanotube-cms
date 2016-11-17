<pre>
<?php
//setup error reporting (for sure ...)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/nanotube-cms/impl/Passwording.php');
$pass = new PAsswording();

$passs = Array("password","HelloThisIsMyPassword","alenka","1234","fsdklfmsd4f32ds","jisddDSD5d!dfjd4aA","MyL1tll3C0untry","yeahreallystrongandlongpassword","areyousureyoucanttouchM3?");

foreach ($passs as $paswd) {
	$h = $pass->generate_password_hash($paswd);
	echo "L(h) = " . strlen($h[0]) . ", L(s) = " . strlen($h[1]) . ", h = " . $h[0] . ", s = " . $h[1] . "\n";
}

$h1 = $pass->generate_password_hash("password");
$h2 = $pass->generate_password_hash("HelloCoolPassYea");
$h3 = $pass->generate_password_hash("LoremIpsum42");

echo "matches? " . $pass->matches("password", $h1[0], $h1[1]) . "\n";
echo "matches? " . $pass->matches("passwordx", $h1[0], $h1[1]) . "\n";
echo "matches? " . $pass->matches("", $h1[0], $h1[1]) . "\n";

echo "matches? " . $pass->matches("HelloCoolPassYea", $h2[0], $h2[1]) . "\n";
echo "matches? " . $pass->matches("password", $h2[0], $h2[1]) . "\n";
echo "matches? " . $pass->matches("DSFkjsdf0", $h2[0], $h2[1]) . "\n";

echo "matches? " . $pass->matches("LoremIpsum42", $h3[0], $h3[1]) . "\n";
echo "matches? " . $pass->matches("LoremIpsum42And", $h3[0], $h3[1]) . "\n";
echo "matches? " . $pass->matches("LoremIpsum", $h3[0], $h3[1]) . "\n";



?>
</pre>
