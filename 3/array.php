<!DOCTYPE html>
<html>
<head>
	<title>Array</title>
</head>
<body>
<?php
$nama = array("Budi", "Agus", 15, "Iwan");
// $nama = ["Budi", "Agus", "Iwan"];

//echo $nama;
echo var_export($nama, true) . "<br>";
echo "Banyak item nama: " . count($nama) . "<br>";
for ($i = 0; $i < count($nama); $i++) {
	echo "<p>$i. " . $nama[$i] . "</p>";
}

// foreach
foreach ($nama as $n) {
	echo "<p>$n</p>";
}
?>
</body>
</html>