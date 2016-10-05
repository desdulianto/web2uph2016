<?php
function hitung_tanggal($date1, $date2) {
    // date_create($date)
    // menghasilkan object DateTime dari string $date
    // object DateTime bisa digunakan untuk fungsi-fungsi date lainnya
    // misalnya pada contoh ini dipakai untuk menghitung interval tanggal
    // http://php.net/manual/en/class.datetime.php
    // http://php.net/manual/en/datetime.construct.php
    // http://php.net/manual/en/function.date-create.php
    $d1 = date_create($date1);
    $d2 = date_create($date2);

    // date_diff($date1, $date2)
    // menghitung interval tanggal $date2-$date1
    // $date1 dan $date2 adalah object date
    // hasil dari date_diff adalah object DateInterval dengan atribut
    // y, m, d untuk tahun, bulan dan hari.
    // http://php.net/manual/en/class.dateinterval.php
    return date_diff($d1, $d2);
}

// memeriksa semua variable yang dikirim oleh user
function check_request($method, $vars) {
    // cara cerdik alternatif if untuk memilih variable apa yang akan
    // digunakan untuk pengecekan.
    $methods = array("post"=>$_POST, "get"=>$_GET, "request"=>$_REQUEST);

    $req = $methods[$method];

    $valid = true;

    foreach ($vars as $var) {
        if (! isset($req[$var])) {
            $valid = false;
            break;
        }
    }

    return $valid;
}
?>
