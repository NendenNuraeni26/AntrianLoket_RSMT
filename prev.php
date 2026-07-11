<?php
include "koneksi.php";

$loket = $_GET['loket'] ?? 1;
$nomorSekarang = $_GET['nomor'] ?? 0;

$nomorSekarang = (int)$nomorSekarang;

// hitung nomor sebelumnya
if($nomorSekarang > 1){
    $prev = $nomorSekarang - 1;
}else{
    $prev = 1;
}

// simpan log panggilan agar display berbunyi
$conn->query("INSERT INTO antrian_panggil(nomor,loket,recall)
VALUES('$prev','$loket',1)");

echo $prev;
?>