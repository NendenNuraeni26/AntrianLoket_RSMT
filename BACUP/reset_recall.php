<?php
include "koneksi.php";

$id = $_GET['id'] ?? 0;

if($id){
    $conn->query("UPDATE antrian_panggil
    SET recall='0'
    WHERE id='$id'");
}
?>