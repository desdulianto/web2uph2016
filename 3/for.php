<!DOCTYPE html>
<html>
<head>
	<title>Looping: for</title>
	<style type="text/css">
		span { display: inline-block; width: 50px; }
	</style>
</head>
<body>
<?php
for ($i = 1; $i <= 10; $i+=3) {
	//if ($i % 2 == 1)
		echo "<p>$i. Saya sedang belajar pemrograman web.</p>";
}

for ($i = 1; $i <= 5; $i++) {
	for ($j = 1; $j <= 5; $j++) {
		echo "<span>" . ($i * $j) . " </span>";
	}
	echo "<br>";
}
?>
</body>
</html>