<!DOCTYPE html>
<html>
<head>
	<title>Array Multi</title>
	<style type="text/css">
		span { display: inline-block; width: 50px; }
		table, td, th { border: 1px solid black; }
		table { border-collapse: collapse; }
		th { background-color: gray; }

	</style>
</head>
<body>
<?php
$telp = array(array("Budi", "1234"),
			  array("Agus", "5677"),
			  array("Rudi", "5555"),
			  array("Susi", "3333"));

for ($i = 0; $i < count($telp); $i++) {
	for ($j =0; $j < count($telp[$i]); $j++) {
		echo "<span>" . $telp[$i][$j] . "</span>";

	}
	echo "<br>";
}
?>
	<table>
		<tr><th>Nama</th><th>Telp</th></tr>
<?php
		for ($i = 0; $i < count($telp); $i++) {
			/*if ($i % 2 == 0)
				$bg = "white";
			else
				$bg = "yellow";*/
			$bg = $i % 2 == 0 ? "white" : "yellow";
			echo "<tr style=\"background-color:$bg\">";
			for ($j = 0; $j < count($telp[$i]); $j++) {
				echo "<td>";
				echo $telp[$i][$j];
				echo "</td>";
			}
			echo "</tr>";
		}
?>
	</table>
</body>
</html>