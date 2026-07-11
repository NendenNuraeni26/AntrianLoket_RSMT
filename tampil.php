<?php
include "koneksi.php";

$q = $conn->query("SELECT * FROM antrian_panggil ORDER BY id DESC LIMIT 1");
$d = $q->fetch_assoc();

$id    = $d['id'] ?? 0;
$nomor = $d['nomor'] ?? "-";
$loket = $d['loket'] ?? "-";
?>

<!DOCTYPE html>
<html>
<head>
<title>Display Antrian</title>

<style>

body{
margin:0;
background:#0f172a;
color:white;
font-family:Segoe UI;
text-align:center;
}

.judul{
font-size:50px;
margin-top:40px;
}

.nomor{
font-size:200px;
font-weight:bold;
margin-top:40px;
color:#22c55e;
}

.loket{
font-size:80px;
margin-top:20px;
}

/* tombol aktifkan suara */
.sound{
position:fixed;
bottom:20px;
right:20px;
background:#22c55e;
color:white;
padding:15px 25px;
font-size:18px;
border-radius:10px;
cursor:pointer;
}

</style>
</head>

<body>

<div class="judul">ANTRIAN SAAT INI</div>

<div class="nomor" id="nomor">
<?php echo $nomor ?>
</div>

<div class="loket" id="loket">
LOKET <?php echo $loket ?>
</div>

<div class="sound" id="aktifkan">
🔊 AKTIFKAN SUARA
</div>

<script>

var lastID = <?php echo $id ?>;
var suaraAktif = false;

/* =====================
AKTIFKAN SUARA
===================== */

document.getElementById("aktifkan").onclick=function(){

suaraAktif = true;
this.style.display="none";

}

/* =====================
CEK PANGGILAN
===================== */

setInterval(function(){

fetch("cek.php?id="+lastID)
.then(res=>res.json())
.then(data=>{

if(data.status=="ada"){

lastID = data.id;

document.getElementById("nomor").innerText = data.nomor;
document.getElementById("loket").innerText = "LOKET "+data.loket;

if(suaraAktif){
panggil(data.nomor,data.loket);
}

}

})

},2000);


/* =====================
SUARA
===================== */

function panggil(nomor,loket){

let list = [

"suara/notification.wav",
"suara/antrian.wav",
"suara/"+nomor+".wav",
"suara/counter.wav",
"suara/"+loket+".wav"

];

play(list,0);

}

function play(arr,i){

if(i>=arr.length) return;

let audio = new Audio(arr[i]);

audio.play();

audio.onended=function(){

play(arr,i+1);

}

}

</script>

</body>
</html>