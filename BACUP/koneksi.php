<?php
$host="localhost";
$user="root";
$pass="Tuban12345";
$db="rsmt";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    die("Koneksi gagal");
}
?>