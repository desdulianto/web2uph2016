<!DOCTYPE html>
<html>
<head>
	<title>PHP Operator</title>
</head>
<body>
<?php
	$a = 5;
	$b = "5";
	$c = 5.0;

	echo "$a == " . var_export($b, true) . " = " . var_export($a == $b, true) . "<br>";
	echo "$a === " . var_export($b, true) . " = " . var_export($a === $b, true) . "<br>";
	echo "$a == " . var_export($c, true) . " = " . var_export($a == $c, true) . "<br>";
	echo "$a === " . var_export($c, true) . " = " . var_export($a === $c, true) . "<br>";

	echo "<p>pre & post increment</p>";
	$a = 5;
	$b = ++$a + 5;
	echo "<p>pre increment</p>";
	echo "a = $a<br>";
	echo "b = $b<br>";

	$a = 5;
	$b = $a++ + 5;
	echo "<p>post increment</p>";
	echo "a = $a<br>";
	echo "b = $b<br>";

	echo "<p>menampilkan literal $: \$a</p>";
	//echo "$nama";

	echo "<p>Operator logical</p>";
	$a = true;
	$b = true;
	echo "$a xor $b = " . var_export($a xor $b, true) . "<br>";
?>
</body>
</html>