<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proses Request GET Web Form</title>
</head>
<body>
<?php
require_once "utils.php";

// data request get diakses dengan variable super global $_GET
if (check_request("get", array("nama", "lahir"))) {
    $nama = $_GET["nama"];
    $lahir = $_GET["lahir"];
    // date($format)
    // tanggal sekarang dengan format mengikuti string $format.
    // Y --> tahun 4 digit
    // m --> bulan 2 digit
    // d --> tanggal 2 digit
    // untuk format lengkap: http://php.net/manual/en/function.date.php
    $sekarang = date("Y-m-d");
    $usia = hitung_tanggal($lahir, $sekarang);

    echo "<p>Hallo $nama, sekarang anda berusia " . $usia->y . " tahun, " . $usia->m . " bulan, " . $usia->d . " hari.</p>";
} else {
    echo "<p>Data belum diisi.</p>";
}
?>
<a href="form.html">Kembali ke form</a>
</body>
</html>
