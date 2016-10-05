<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proses Request GET & POST Web Form</title>
</head>
<body>
<?php
require_once "utils.php";

function zodiak($lahir) {
    // ambil komponen tahun dari tanggal lahir
    $tahun = intval($lahir->format('Y'));

    // bangun range tanggal untuk masing-masing bintang
    $zod = array(
                 "Capricorn"=>array(new DateTime($tahun . "-1-1"), new DateTime($tahun . "-1-20")),
                 "Aquarius"=>array(new DateTime($tahun . "-1-21"), new DateTime($tahun . "-2-19")),
                 "Pisces"=>array(new DateTime($tahun . "-2-20"), new DateTime($tahun . "-3-20")),
                 "Aries"=>array(new DateTime($tahun . "-3-21"), new DateTime($tahun . "-4-20")),
                 "Taurus"=>array(new DateTime($tahun . "-4-21"), new DateTime($tahun . "-5-21")),
                 "Gemini"=>array(new DateTime($tahun . "-5-22"), new DateTime($tahun . "-6-21")),
                 "Cancer"=>array(new DateTime($tahun . "-6-22"), new DateTime($tahun . "-7-22")),
                 "Leo"=>array(new DateTime($tahun . "-7-23"), new DateTime($tahun . "-8-22")),
                 "Virgo"=>array(new DateTime($tahun . "-8-23"), new DateTime($tahun . "-9-23")),
                 "Libra"=>array(new DateTime($tahun . "-9-24"), new DateTime($tahun . "-10-23")),
                 "Scorpio"=>array(new DateTime($tahun . "-10-24"), new DateTime($tahun . "-11-22")),
                 "Sagitarius"=>array(new DateTime($tahun . "-11-23"), new DateTime($tahun . "-12-21")),
                 // whoops karena array assosiatif, key tidak boleh sama....
                 "Capricorn "=>array(new DateTime($tahun . "-12-22"), new DateTime($tahun . "-12-31"))
                );

    // check tanggal lahir dengan range tanggal masing-masing bintang
    // $z -> nama bintang
    // $t -> array tanggal awal dan tanggal akhir
    foreach ($zod as $z => $t) {
        if ($lahir >= $t[0] && $lahir <= $t[1])
            return trim($z);
    }
}

// data request get diakses dengan variable super global $_GET
// data request post diakses dengan variable super global $_POST
// data request post & get dapat diakses dengan variable super global $_REQUEST
if (check_request("request", array("nama", "lahir", "mode"))) {
    $nama = $_REQUEST["nama"];   // $nama = $_POST["nama"];
    $lahir = $_REQUEST["lahir"]; // $lahir = $_POST["lahir"];

    $mode = $_REQUEST["mode"];  // $mode = $_GET["mode"];

    switch ($mode) {
        case "usia":
        case "umur":
            $sekarang = date("Y-m-d");
            $usia = hitung_tanggal($lahir, $sekarang);
            echo "<p>Hallo $nama, sekarang anda berusia " . $usia->y . " tahun, " . $usia->m . " bulan, " . $usia->d . " hari.</p>";
            break;
        case "zodiak":
        case "bintang":
            $birth = new DateTime($lahir);
            $bintang = zodiak($birth);

            echo "<p>Hello $nama, bintang/zodiak anda adalah: $bintang.</p>";
            break;
        default:
            echo "<p>Mau menampilkan apa ya?</p>";
    }
} else {
    echo "<p>Data belum diisi.</p>";
}
?>
</body>
</html>
