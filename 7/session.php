<?php
// session harus dimulai sebelum ada output sama sekali ke client
session_start();

// mengakses super global variable $_SESSION
if (! isset($_SESSION["count"]))
    $count = 0;
else
    $count = $_SESSION["count"];

$count++;
$_SESSION["count"] = $count;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh Session</title>
</head>
<body>
<?php
if ($count == 1)
    echo "<p>Hello, selamat datang</p>";
else
    echo "<p>Hello, selamat datang kembali untuk ke-$count kalinya.</p>";
?>
<p><a href="destroy.php">Hapus session</a></p>
</body>
</html>
