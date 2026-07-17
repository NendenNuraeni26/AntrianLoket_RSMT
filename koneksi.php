<?php
$host="192.168.x.x";
$user="nendencantik";
$pass="1234567cvg";
$db="dbmu";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    die("Koneksi gagal");
}
?>
