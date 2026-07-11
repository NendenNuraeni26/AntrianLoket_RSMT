<?php
include "koneksi.php";

// Ambil nomor terakhir
$q = $conn->query("SELECT id, nomor, loket, recall 
FROM antrian_panggil
ORDER BY id DESC
LIMIT 1");

$data = $q->fetch_assoc();

if(!$data){
    $data = [
        "id" => 0,
        "nomor" => "-",
        "loket" => "-",
        "recall" => 0
    ];
}

echo json_encode($data);
?>