<!DOCTYPE html>
<html>
<head>
	<title>Array assosiatif/Dictionary</title>
</head>
<body>
<?php
$kontak = array(array("nama"=>"Budi", "telp"=>"1234", "alamat"=>"def"),
				array("nama"=>"Susi", "telp"=>"5678", "alamat"=>"jki"));
?>
	<table>
		<tr><th>Nama</th><th>Telp</th></tr>
<?php
		$kolom = ["nama", "telp"];
		for ($i = 0; $i < count($kontak); $i++) {
			echo "<tr>";
			//foreach ($kontak[$i] as $key => $value) {
			//foreach ($kontak[$i] as $value) {
			foreach ($kolom as $k) {
				echo "<td>";
				//echo $key . ": " . $value;
				echo $kontak[$i][$k];	
				echo "</td>";
			}
			echo "</tr>";
		}
?>
	</table>
</body>
</html>