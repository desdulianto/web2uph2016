<!DOCTYPE html>
<html>
<head>
	<title>Array assosiatif/Dictionary</title>
</head>
<body>
<?php
$kontak = array(array("nama"=>"Budi", "telp"=>"1234", "alamat"=>"Jl. Asia"),
				array("nama"=>"Susi", "telp"=>"5678", "alamat"=>"Jl. Thamrin"));
?>
	<table>
		<tr><th>Nama</th><th>Telp</th><th>Alamat</th></tr>
<?php
		for ($i = 0; $i < count($kontak); $i++) {
			echo "<tr>";
            foreach ($kontak[$i] as $value) {
				echo "<td>";
                echo $value;
				echo "</td>";
			}
			echo "</tr>";
		}
?>
	</table>
<?php
    echo "<h1>Looping dengan key=>value</h1>";

    echo "<ul>";
    foreach ($kontak as $k) {
        echo "<li>";
        echo "<address>";
        foreach ($k as $key => $value) {
            echo "<b>$key</b>: $value<br>";
        }
        echo "</address>";
        echo "</li>";
    }
    echo "</ul>";

    echo "<h1>Looping untuk menampilkan data nama dan telp saja</h1>";
    $keys = array("nama", "telp");
    echo "<ul>";
    foreach ($kontak as $k) {
        echo "<li>";
        echo "<address>";
        foreach ($keys as $i) {
            echo "<b>$i</b>: ". $k[$i] . "<br>";
        }
        echo "</address>";
        echo "</li>";
    }
    echo "</ul>";
?>
</body>
</html>
