<?php
$host="192.168.10.10";
$user="nenden";
$pass="1234567";
$db="rsmt";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    die("Koneksi gagal");
}
?>