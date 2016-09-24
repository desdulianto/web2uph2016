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
    </style>
</head>
<body>
    <h1>Jadwal KA Sumatra Utara</h1>

<?php
// include-kan file php yang berisi array data
// jadwal KA
require_once "dataka.php";

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
foreach ($data as $item) {
    echo "<tr class=\"$row\">";
    // tampilkan masing2 kolom secara manual
    echo "<td>" . $item['stasiun_keberangkatan'] . "</td>";
    echo "<td>" . $item['waktu_keberangkatan'] . "</td>";
    echo "<td>" . $item['stasiun_kedatangan'] . "</td>";
    echo "<td>" . $item['waktu_kedatangan'] . "</td>";
    echo "<td>" . $item['nama_ka'] . "</td>";
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
