<!DOCTYPE html>
<html>
<head>
<title>Display Antrian - RS Muhammadiyah Tuban</title>

<style>

body{
margin:0;
font-family:Segoe UI, Arial, sans-serif;
background:#f4f7fb;
color:#2c3e50;
overflow:hidden;
}

/* NAVBAR */
.navbar{
background:#0d6efd;
color:white;
display:flex;
align-items:center;
padding:10px 30px; /* diperkecil agar tidak terlalu turun */
box-shadow:0 2px 10px rgba(0,0,0,0.2);
}

.logo{
width:50px;
margin-right:15px;
}

.rs-info{
line-height:1.2;
}

.rs-nama{
font-size:26px;
font-weight:bold;
}

.rs-alamat{
font-size:14px;
opacity:0.9;
}

/* LAYOUT */
.main{
display:flex;
height:calc(100vh - 80px); /* lebih tinggi supaya tidak kepotong */
padding:5px 10px;
gap:15px;
}

/* KIRI */
.kiri{
flex:1;
display:flex;
flex-direction:column;
align-items:center;
justify-content:center;
}

/* KANAN */
.kanan{
flex:1;
display:flex;
align-items:center;
justify-content:center;
}

/* VIDEO */
.video-box{
width:100%;
height:50%;
background:black;
border-radius:15px;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.video-box iframe{
width:100%;
height:100%;
border:0;
}

/* JUDUL */
.judul{
font-size:36px;
font-weight:600;
margin-bottom:20px; /* diperkecil */
}

/* NOMOR */
.nomor-box{
background:white;
padding:40px 80px;
border-radius:20px;
box-shadow:0 10px 40px rgba(0,0,0,0.15);
}

.nomor{
font-size:140px;
font-weight:bold;
color:#0d6efd;
}

.loket{
margin-top:20px;
font-size:45px;
font-weight:600;
}

/* FOOTER */
.footer{
position:fixed;
bottom:0;
width:100%;
text-align:center;
padding:8px;
background:white;
border-top:1px solid #ddd;
font-size:16px;
}

</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
<img src="gambar/logors.png" class="logo">

<div class="rs-info">
<div class="rs-nama">RS Muhammadiyah Tuban</div>
<div class="rs-alamat">Jl Diponegoro No 1 Tuban</div>
</div>

</div>

<!-- MAIN -->
<div class="main">

<!-- KIRI DISPLAY -->
<div class="kiri">

<div class="judul">ANTRIAN LOKET</div>

<div class="nomor-box">
<div class="nomor" id="nomor">-</div>
</div>

<div class="loket" id="loket">Loket -</div>

</div>


<!-- KANAN VIDEO -->
<div class="kanan">

<div class="video-box">

<iframe
src="https://www.youtube.com/embed/S5qk9UbOlVs?autoplay=1&mute=1&loop=1&playlist=S5qk9UbOlVs"
allow="autoplay; fullscreen">
</iframe>

</div>

</div>

</div>

<div class="footer">
Harap menunggu hingga nomor antrian Anda dipanggil
</div>

<script>

let lastNomor = "";
let lastLoket = "";
let suaraAktif = true;


/* SUARA PANGGIL */
function speak(nomor,loket){

if(nomor == "-" || nomor == "") return;

speechSynthesis.cancel();

let text = "Nomor antrian "+nomor+" silahkan menuju loket "+loket;

let msg = new SpeechSynthesisUtterance(text);
msg.lang = "id-ID";
msg.rate = 0.9;
msg.pitch = 1;
msg.volume = 1;

speechSynthesis.speak(msg);

}


/* LOAD DATA */
function load(){

fetch("get_display.php")
.then(res => res.json())
.then(data => {

let nomorBaru = data.nomor ?? "-";
let loketBaru = data.loket ?? "-";

document.getElementById("nomor").innerHTML = nomorBaru;
document.getElementById("loket").innerHTML = "Loket "+loketBaru;


/* jika nomor berubah atau recall */
if(data.recall == 1 || nomorBaru != lastNomor){

speak(nomorBaru,loketBaru);

if(data.recall == 1){
fetch("reset_recall.php?id="+data.id);
}

}

lastNomor = nomorBaru;
lastLoket = loketBaru;

});

}


/* REFRESH DATA */
setInterval(load,1000);

</script>

</body>
</html>