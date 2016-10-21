<?php
session_start();
// menghapus data session
session_destroy();

// arahkan (redirect) kembali browser ke halaman session
header("Location: session.php");
?>
