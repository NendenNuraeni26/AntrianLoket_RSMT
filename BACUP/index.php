<!DOCTYPE html>
<html>
<head>
<title>Pilih Loket</title>

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
padding:18px 40px;
display:flex;
align-items:center;
box-shadow:0 2px 10px rgba(0,0,0,0.2);
}

.logo{
width:55px;
margin-right:15px;
}

.rs-text{
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

/* TITLE */

.title{
text-align:center;
margin-top:60px;
font-size:42px;
font-weight:600;
}

/* GRID */

.container{
width:900px;
margin:50px auto;
display:grid;
grid-template-columns:repeat(2,1fr);
gap:20px;
}

/* BOX */

.box{
height:150px;
border-radius:18px;
display:flex;
align-items:center;
justify-content:center;
font-size:42px;
font-weight:bold;
color:white;
box-shadow:0 10px 30px rgba(0,0,0,0.15);
cursor:pointer;
transition:0.25s;
}

.box:hover{
transform:translateY(-8px);
box-shadow:0 18px 40px rgba(0,0,0,0.25);
}

a{
text-decoration:none;
}

/* WARNA LOKET */

.loket1{ background:#0d6efd; }
.loket2{ background:#27ae60; }
.loket3{ background:#f39c12; }
.loket4{ background:#8e44ad; }

</style>
</head>

<body>

<div class="navbar">

<img src="gambar/logors.png" class="logo">

<div class="rs-text">
<div class="rs-nama">RS Muhammadiyah Tuban</div>
<div class="rs-alamat">Jl Diponegoro No 1 Tuban</div>
</div>

</div>

<div class="title">Pilih Loket Pelayanan</div>

<div class="container">

<a href="panggil.php?loket=1">
<div class="box loket1">Loket 1</div>
</a>

<a href="panggil.php?loket=2">
<div class="box loket2">Loket 2</div>
</a>

<a href="panggil.php?loket=3">
<div class="box loket3">Loket 3</div>
</a>

<a href="panggil.php?loket=4">
<div class="box loket4">Loket 4</div>
</a>

</div>

</body>
</html>