<!DOCTYPE html>
<html>
<head>
	<title>Percabangan 2</title>
</head>
<body>
	<form method="get" action="">
		<div>
		<label>Nama</label>
		<input type="text" name="nama">
		</div>
		<div>
		<label>Mata Kuliah</label>
		<input type="text" name="mkuliah">
		</div>
		<div>
		<label>Nilai</label>
		<input type="text" name="nilai">
		</div>
		<div>
		<input type="submit">
		</div>
	</form>
	<?php
	if (isset($_GET["nama"]) && isset($_GET["mkuliah"]) && isset($_GET["nilai"])) {
		if ($_GET["nama"] == "" || $_GET["mkuliah"] == "" || $_GET["nilai"] == "") {
			$hasil = "Data salah";
		} else {
			$nilai = $_GET["nilai"];
			if (is_numeric($nilai)) {
				if ($_GET["nilai"] >= 0 && $_GET["nilai"] <= 100) {
					if ($_GET["nilai"] >= 60) {
						$hasil = "Lulus";
					} else {
						$hasil = "Tidak Lulus";
					}				
				} else {
					$hasil = "Nilai salah";
				}
			} else {
				$hasil = "Nilai salah";
			}
		}
		echo $hasil;
	}
	?>
</body>
</html>