<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proses Request POST Web Form</title>
</head>
<body>
<?php
require_once "utils.php";

// data request post diambil melalui variable super global $_POST
if (check_request("post", array("nama", "jenis_kelamin", "pendidikan", "hobi", 
    "keterangan"))) {
    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $pendidikan = $_POST["pendidikan"];
    // join (delimiter, array)
    // menggabungkan array menjadi string
    // delimiter adalah string pemisah untuk masing-masing item array yang digabung
    // cth: $nama = array("Budi", "Iwan", "Susi")
    // join("|", $nama) --> "Budi|Iwan|Susi"
    $hobi = join(", ", $_POST["hobi"]);
    $keterangan = $_POST["keterangan"];

    echo "<p>Hello $nama, kamu seorang $jenis_kelamin dengan pendidikan $pendidikan</p>";
    echo "<p>Hobi kamu: $hobi.</p>";
    echo "<p>Informasi tambahan:</p>";
    echo "<pre>$keterangan</pre>";
} else {
    echo "<p>Data belum diinput. <a href=\"form.html\">Input data</a>.</p>";
}
?>
<a href="form.html">Kembali ke form</a>
</body>
</html>
