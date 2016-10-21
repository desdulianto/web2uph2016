<?php
session_start();

if (! isset($_SESSION["username"])) {
    $pesan = "<p><a href=\"login.php\">Login</a> terlebih dahulu</p>";
} else {
    $username = $_SESSION["username"];
    $pesan = "<p>Hello $username</p>
              <p>Selamat datang</p>
              <p><a href=\"logout.php\">Logout</a></p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
    echo $pesan;
?>
</body>
</html>
