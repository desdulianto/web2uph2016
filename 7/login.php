<?php
session_start();

// jika sudah pernah login, arahkan ke halaman content
if (isset($_SESSION["username"]))
    header("Location: content.php");

if (isset($_POST["username"]) &&
    isset($_POST["password"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    // cek login
    if ($username == "superman" && $password == "batman") {
        $_SESSION["username"] = $username;
        header("Location: content.php");
    }

    // login gagal
    $pesan = "<p>Username/Password salah</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh login</title>
</head>
<body>
    <form method="post" action="login.php">
        <div>
            <label for="username">Username</label>
            <input id="username" name="username" type="text">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <?php if (isset($pesan))
                echo $pesan;
        ?>
        <div><input type="submit" value="Login"></div>
    </form>
</body>
</html>
