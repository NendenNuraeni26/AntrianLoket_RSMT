<?php
include "koneksi.php";

$id = $_GET['id'] ?? 0;

$q = $conn->query("SELECT * FROM antrian_panggil 
WHERE id > '$id'
ORDER BY id DESC
LIMIT 1");

if($q->num_rows > 0){

$d = $q->fetch_assoc();

echo json_encode([
"status"=>"ada",
"id"=>$d['id'],
"nomor"=>$d['nomor'],
"loket"=>$d['loket']
]);

}else{

echo json_encode([
"status"=>"tidak"
]);

}
?>