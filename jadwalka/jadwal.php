<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jadwal KA</title>
    <style type="text/css">
        table, td, th { border: 1px solid black; 
                padding: 0.5em;
            }
        table { border-collapse: collapse; }
        thead tr { background-color: #5DFF50; }
        tbody tr.odd { background-color: #FFEAB4; }
        tbody tr.even { background-color: #98E8FF; }
        form { margin: 1em; }
    </style>
</head>
<body>
    <h1>Jadwal KA Sumatra Utara</h1>


<?php
// include-kan file php yang berisi array data
// jadwal KA
require_once "dataka.php";

// bentuk list berisikan daftar stasiun tujuan untuk digunakan pada pilihan di
// form
$daftar_tujuan = array();

foreach ($data as $item) {
    if (! in_array($item['stasiun_kedatangan'], $daftar_tujuan))
        array_push($daftar_tujuan, $item['stasiun_kedatangan']);
}
?>
    <form method="get" action="">
        <label for="tujuan">Tujuan:</label>
        <select name="tujuan">
            <option value="">Kemana saja</option>
<?php
// tambahkan option sesuai dengan array $daftar_tujuan
foreach ($daftar_tujuan as $t) {
    echo "<option value=\"$t\">$t</option>";
}
?>
        </select>
        <input type="submit" value="Saring">
    </form>

<?php
// tampilkan tabel jadwal data ka
echo "<table>";
echo "<thead>";
echo "<tr><th>Stasiun keberangkatan</th><th>Waktu keberangkatan</th>
    <th>Stasiun kedatangan</th><th>Waktu kedatangan</th>
    <th>Nama Kereta Api</th></tr>";
echo "</thead>";
echo "<tbody>";

// untuk class tr per masing-masing baris
$row = "odd";

// key untuk loop terhadap kolom data
$cols = array('stasiun_keberangkatan', 'waktu_keberangkatan', 
              'stasiun_kedatangan', 'waktu_kedatangan', 'nama_ka');

// baca data yang dikirim oleh user (jika ada)
$tujuan = "";
if (isset($_GET["tujuan"]))
    $tujuan = $_GET["tujuan"];

foreach ($data as $item) {
    echo "<tr class=\"$row\">";

    // menampilkan kolom sesuai dengan key yang ada di $cols
    foreach ($cols as $col) {
        // filter dengan if hanya menampilkan stasiun kedatangan sesuai dengan
        // yang dipilih user. Jika tujuan = "" tampilkan semua jadwal
        if ($tujuan != "" && $tujuan != $item['stasiun_kedatangan'])
            continue;

        echo "<td>" . $item[$col] . "</td>";
    }
    echo "</tr>";

    // flip class tr odd even
    if ($row == "odd")
        $row = "even";
    else
        $row = "odd";
}
echo "</tbody>";
echo "</table>";
?>
</body>
</html>
