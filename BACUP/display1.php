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
}

/* NAVBAR */
.navbar{
background:#0d6efd;
color:white;
display:flex;
align-items:center;
padding:15px 40px;
box-shadow:0 2px 10px rgba(0,0,0,0.2);
}

.logo{
width:60px;
margin-right:20px;
}

.rs-info{
line-height:1.3;
}

.rs-nama{
font-size:28px;
font-weight:bold;
}

.rs-alamat{
font-size:16px;
opacity:0.9;
}

/* CONTAINER */
.container{
text-align:center;
margin-top:40px;
}

.judul{
font-size:40px;
font-weight:600;
margin-bottom:40px;
}

/* NOMOR */
.nomor-box{
display:inline-block;
background:white;
padding:40px 100px;
border-radius:20px;
box-shadow:0 10px 40px rgba(0,0,0,0.15);
}

.nomor{
font-size:160px;
font-weight:bold;
color:#0d6efd;
}

.loket{
margin-top:25px;
font-size:50px;
font-weight:600;
}

/* FOOTER */
.footer{
position:fixed;
bottom:0;
width:100%;
text-align:center;
padding:12px;
background:white;
border-top:1px solid #ddd;
font-size:18px;
}

/* BUTTON SOUND */
.soundbtn{
position:fixed;
top:50%;
left:50%;
transform:translate(-50%,-50%);
background:#0d6efd;
color:white;
font-size:30px;
padding:20px 40px;
border-radius:12px;
cursor:pointer;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
z-index:9999;
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

<!-- DISPLAY -->
<div class="container">
<div class="judul">ANTRIAN LOKET</div>

<div class="nomor-box">
<div class="nomor" id="nomor">-</div>
</div>

<div class="loket" id="loket">Loket -</div>
</div>

<div class="footer">
Harap menunggu hingga nomor antrian Anda dipanggil
</div>

<!-- TOMBOL AKTIFKAN SUARA -->
<div class="soundbtn" id="aktifkan">
🔊 AKTIFKAN SUARA
</div>

<script>

let lastNomor = "";
let lastLoket = "";
let suaraAktif = false;

// aktifkan suara manual
document.getElementById("aktifkan").onclick = function(){

    suaraAktif = true;

    let msg = new SpeechSynthesisUtterance("Sistem antrian aktif");
    msg.lang = "id-ID";
    msg.rate = 0.9;
    msg.pitch = 1;

    speechSynthesis.speak(msg);

    this.style.display = "none";
}

// fungsi suara
function speak(nomor,loket){

    if(!suaraAktif) return;
    if(nomor == "-" || nomor == "") return;

    let text = "Nomor antrian "+nomor+" silahkan menuju loket "+loket;

    let msg = new SpeechSynthesisUtterance(text);
    msg.lang = "id-ID";
    msg.rate = 0.9;
    msg.pitch = 1;

    speechSynthesis.cancel();
    speechSynthesis.speak(msg);
}

// load data
function load(){

fetch("get_display.php")
.then(res => res.json())
.then(data => {

let nomorBaru = data.nomor ?? "-";
let loketBaru = data.loket ?? "-";

document.getElementById("nomor").innerHTML = nomorBaru;
document.getElementById("loket").innerHTML = "Loket "+loketBaru;

// bunyikan jika nomor berubah atau recall
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

// refresh setiap 1 detik
setInterval(load,1000);

</script>

</body>
</html>