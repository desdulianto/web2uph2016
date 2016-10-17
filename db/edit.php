<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh database</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit data produk</h1>    
<?php
require_once "db.php";

if (! isset($_GET["id"]))
    die("<p>ID produk tidak diketahui</p>");

$conn = konek_db();

$id = $_GET["id"];

// periksa apakah id produk yang akan di-edit memang tersedia di database
$rows = get_produk_by_id($conn, $id);

if (! $rows)
    die("<p>Gagal query</p>");

if ($rows->num_rows == 0)
    die("<p>Produk id $id tidak ditemukan</p>");

// tarik data dari result set ke object
$row = $rows->fetch_object();
$nama = $row->nama;
$harga = $row->harga;
?>

    <form method="post" action="update.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <div>
            <label>Nama Produk:</label>
            <input type="text" name="nama" placeholder="Nama Produk" 
                value="<?php echo $nama; ?>">
        </div>
        <div>
            <label>Harga Produk:</label>
            <input type="number" name="harga" placeholder="Harga" 
                value="<?php echo $harga; ?>">
        </div>
        <div>
            <input type="submit" value="Update">
            <a href="read.php"><button type="button">Batal</button></a>
        </div>
    </form>

</body>
</html>
