<?php
include "koneksi.php";

$loket = $_GET['loket'] ?? 1;
$nomor = trim($_GET['nomor'] ?? '');

if($nomor === ''){
    echo "kosong";
    exit;
}

// Simpan panggilan custom / recall
$conn->query("INSERT INTO antrian_panggil(nomor,loket,recall)
VALUES('$nomor','$loket',1)");

echo $nomor;
?>