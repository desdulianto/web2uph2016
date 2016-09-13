<!DOCTYPE html>
<html>
<head>
	<title>Percabangan: switch</title>
</head>
<body>
	<form method="get" action="">
		<div>
			<label for="bulan">
			<input type="text" name="bulan">
		</div>
		<div>
			<input type="submit" value="Kirim">
		</div>
	</form>
<?php
	if (isset($_GET["bulan"])) {
		if (is_numeric ($_GET["bulan"])) {
			$bulan = intval($_GET["bulan"]);
			switch ($bulan) {
				case 1: case 3: case 5:	case 7: case 8:	case 10: case 12:
					$hasil = "31 hari"; break;
				case 4: case 6: case 9:	case 11:
					$hasil = "30 hari"; break;
				case 2:
					$hasil = "28/29 hari"; break;
				default:
					$hasil = "Bulan salah";
			}
		} else {
			$hasil = "Bulan salah";
		}
		echo $hasil;
	}
?>
</body>
</html>