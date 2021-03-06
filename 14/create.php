<?php
require_once "db.php";
require_once "twig.php";

if (! isset($_POST["nama"]) || ! isset($_POST["harga"])) {
    echo $twig->render("create.html");
} if (isset($_POST["nama"]) && isset($_POST["harga"])) {
    $nama  = $_POST["nama"];
    $harga = $_POST["harga"];

    // buka koneksi ke db -- db.php
    $conn = konek_db();

    // check apakah ada file yang diupload
    $image   = null;
    $imgname = null;
    if (isset($_FILES["image"])) {
        $image = $_FILES["image"];
    }

    if ($image) {
        if ($image['error'] == 0 && file_exists($image['tmp_name'])) {
            // tentukan lokasi penyimpanan file yang diupload user
            // pathinfo mengembalikan informasi mengenai nama file
            // parameter 1 - string nama file
            // parameter 2, informasi yang akan di-extract dari nama file:
            //      - PATHINFO_DIRNAME -- nama directory
            //      - PATHINFO_BASENAME -- nama file tanpa directory
            //      - PATHINFO_EXTENSION -- nama extension file
            //      - PATHINFO_FILENAME -- nama file tanpa extension
            // ambil nama file
            $filename = pathinfo($image['name'], PATHINFO_FILENAME);
            // ambil nama extension file
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            // lokasi directory tempat menyimpan file yang diupload
            $path = "images";

            $imgname = get_upload_filename($path, $filename, $ext);

            move_uploaded_file($image['tmp_name'], $imgname);
        // error 4 tidak ada file yang di upload
        } else if ($image['error'] != 4) {
            echo $twig->render("error.html", array("pesan"=>"Error upload gambar produk"));
            return;
        }
    }

    // bangun query yang akan dieksekusi menggunakan prepared statement
    // simbol ? pada statement query akan diisikan dengan parameter query
    // sesuai dengan parameter pada pemanggilan method bind_param
    $query = $conn->prepare("insert into produk(nama, harga, image) values(?, ?, ?)");
    // pasangkan parameter query dengan method bind_param
    // parameter pertama adalah string yang berisikan format data 
    // masing-masing parameter query
    // s -- string
    // i -- integer
    // d -- double
    // b -- blob/binary
    // parameter ke-dua dan seterusnya adalah parameter query
    // yang akan dipasangkan pada statement query
    $query->bind_param("sis", $nama, $harga, $imgname);

    // jalankan query
    $result = $query->execute();
    if (! $result) {
        echo $twig->render("error.html", array("pesan"=>"Error query"));
    }

    // redirect ke halaman utama
    header("Location: index.php");
}
?>
