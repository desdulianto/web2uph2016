<!DOCTYPE html>
<html>
<head>
	<title>Loop: while</title>
</head>
<body>
<?php
$i = 1;
/*while ($i <= 100) {
	echo "<p>Saya sedang belajar pemrograman web.</p>";
	$i++;
}*/
do {
	echo "<p>$i. Saya sedang belajar pemrograman web.</p>";

	$i++;
} while($i <= 100);
?>
</body>
</html>