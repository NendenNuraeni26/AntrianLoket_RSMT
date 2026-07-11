<?php
include "koneksi.php";

$loket = $_GET['loket'] ?? 1;

// cari antrian yang belum dipanggil
$q = $conn->query("SELECT nomor FROM antripendaftaran_nomor
WHERE status='0'
ORDER BY jam ASC
LIMIT 1");

if($q->num_rows > 0){

    $d = $q->fetch_assoc();
    $nomor = $d['nomor'];

    // update status jadi sudah dipanggil
    $conn->query("UPDATE antripendaftaran_nomor
    SET status='1'
    WHERE nomor='$nomor'");

}else{

    // jika tidak ada antrian baru
    $q2 = $conn->query("SELECT nomor FROM antripendaftaran_nomor
    ORDER BY CAST(nomor AS UNSIGNED) DESC
    LIMIT 1");

    if($q2->num_rows > 0){
        $d2 = $q2->fetch_assoc();
        $nomor = $d2['nomor'];
    }else{
        $nomor = "-";
    }

}

// simpan log panggilan
$conn->query("INSERT INTO antrian_panggil(nomor,loket,recall)
VALUES('$nomor','$loket',1)");

echo $nomor;
?>