<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh database</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Daftar produk</h1>

    <a href="create.html"><button>Create</button></a>

    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <!--<th>Image</th>-->
        </tr>
        </thead>
        <tbody>
<?php
require_once "db.php";

    // buka koneksi ke database -- menggunakan mysqli
    $conn = konek_db();

    // query seluruh data produk dari database
    $query = $conn->prepare("select * from produk");
    $result = $query->execute();

    if (! $result)
        die("Gagal query");

    // baca hasil query menjadi object result set
    $rows = $query->get_result();

    // loop setiap baris result set sebagai object
    while ($row = $rows->fetch_object()) {
        echo "<tr>";
        echo "<td>$row->id</td>";
        echo "<td>$row->nama</td>";
        echo "<td>$row->harga</td>";
        echo "</tr>";
    }
?>
        </tbody>
    </table>
</body>
</html>
