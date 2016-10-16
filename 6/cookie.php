<?php
// Cookie merupakan data yang disimpan pada browser user.
// Setiap kali user melakukan request ke halaman web ini,
// browser akan mengirimkan cookie yang berkaitan ke server.
// Panjang data cookie terbatas dan tidak disarankan untuk
// menyimpan informasi penting pada cookie apabila tidak
// diproteksi dengan encryption (https).
//
// Pada server cookie diakses dari variable super global
// $_COOKIE
if (! isset($_COOKIE["count"])) {
    $count = 0;
} else {
    $count = $_COOKIE["count"];
}
$count++;
// set cookie ke browser client dengan fungsi setcookie
// parameter 1 - nama variable cookie
// parameter 2 - nilai cookie
// parameter 3 - waktu expired cookie
// pada contoh ini, variable cookie count diisikan dengan
// nilai dari variable $count dan masa expired adalah 60
// detik sejak kunjungan/request terakhir
// fungsi time() mengembalikan nilai waktu sekarang
setcookie("count", $count, time()+60);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh Cookie</title>
</head>
<body>
<?php
if ($count == 1)
    $kalimat = "Hello, selamat datang";
else
    $kalimat = "Hello, ini kunjungan anda yang ke-$count kali";

echo "<p>$kalimat</p>";
echo "<p>Klik <a href=\"reset_cookie.php\">disini</a> untuk reset cookie</p>";
?>
</body>
</html>
