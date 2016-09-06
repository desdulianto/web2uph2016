<!DOCTYPE html>
<html>
<head>
	<title>Percabangan</title>
</head>
<body>
	<form method="get" action="">
		<div>
			<label>Nama:</label>
			<input type="text" name="nama">
		</div>
		<div>
			<input type="submit" value="Kirim">
		</div>
	</form>
	<?php
	if (isset($_GET['nama'])) {
		$nama = $_GET['nama'];
		if ($nama == "")
			$nama = "kawan";
	} else {
		$nama = "world";
	}
	echo "<h1>Hello, $nama </h1>";
	?>
</body>
</html>