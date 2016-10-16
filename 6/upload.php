<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh Upload</title>
</head>
<body>
<?php
// pada sisi server, informasi file yang di-upload diakses melalui variable 
// global $_FILES
if (isset($_FILES["berkas"])) {
    // $_FILES menampung beberapa informasi mengenai file yang diupload yaitu:
    // name     -- nama file
    // type     -- MIME type file
    // tmp_name -- lokasi dan nama file sementara di server. file yang
    //             diupload akan diletakkan di lokasi sementara di server
    //             apabila script yang menerima file upload tidak menyalin
    //             atau memindahkan file tmp_name ke lokasi lain, file
    //             tmp_name akan dihapus secara otomatis.
    // error    -- kode error proses upload file, apabila nilai error == 0
    //             berarti proses upload berhasil
    // size     -- ukuran file dalam satuan bytes
    echo "<table><tr><th>Key</th><th>Value</th></tr>";
    foreach ($_FILES["berkas"] as $key => $value) {
        echo "<tr><td>$key</td><td>$value</td></tr>";
    }
    echo "</table>";

    $berkas = $_FILES["berkas"];
    if ($berkas["error"] == 0) {
        // salin file ke directory upload apabila error == 0 (upload berhasil)
        copy($berkas["tmp_name"], "upload/" . $berkas["name"]);
        $url = "upload/" . $berkas["name"];
        echo "<p>File berhasil diupload <a href=\"$url\">" . $berkas["name"] . 
             "</a></p>";
    } else {
        echo "<p>Gagal meng-upload file. Error code: " . $berkas["error"] . "</p>";
    }
}
?>
</body>
</html>
