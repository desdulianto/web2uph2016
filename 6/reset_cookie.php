<?php
// cookie dihapus dengan cara me-set nilai expired ke waktu
// di masa lalu
setcookie("count", null, time()-1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<p>Cookie sudah di-reset. <a href="cookie.php">Kembali</a></p>
</body>
</html>
