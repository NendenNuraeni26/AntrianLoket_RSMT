<?php
include "koneksi.php";

$loket = $_GET['loket'] ?? 1;

/* ================================
   NOMOR TERAKHIR DIPANGGIL HARI INI
================================ */
$q = $conn->query("SELECT nomor 
FROM antrian_panggil 
WHERE loket='$loket' AND DATE(waktu) = CURDATE()
ORDER BY id DESC 
LIMIT 1");

$d = $q->fetch_assoc();
$nomor = $d['nomor'] ?? 0;

/* ================================
   TOTAL ANTRIAN HARI INI
================================ */
$qtotal = $conn->query("SELECT COUNT(*) as total 
FROM antripendaftaran_nomor
WHERE DATE(jam) = CURDATE()");

$dtotal = $qtotal->fetch_assoc();
$total = $dtotal['total'] ?? 0;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pemanggil Loket <?php echo $loket ?></title>

    <style>
        body {
            margin: 0;
            font-family: Segoe UI, Arial;
            background: #f4f7fb;
        }

        /* NAVBAR */
        .navbar {
            background: #0d6efd;
            color: white;
            padding: 12px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .left {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 50px;
            margin-right: 12px;
        }

        .rs {
            font-size: 18px;
            font-weight: bold;
        }

        .alamat {
            font-size: 12px;
            opacity: 0.9;
        }

        .loket-title {
            font-size: 22px;
            font-weight: bold;
        }

        /* CONTAINER */
        .container {
            text-align: center;
            margin-top: 40px;
        }

        /* PANEL */
        .panel {
            background: white;
            width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* NOMOR */
        .nomor {
            font-size: 120px;
            font-weight: bold;
            margin: 25px;
            color: #0d6efd;
        }

        /* BUTTON */
        button {
            font-size: 22px;
            padding: 15px 35px;
            margin: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            transform: scale(1.05);
        }

        .next {
            background: #27ae60;
            color: white;
        }

        .prev {
            background: #f39c12;
            color: white;
        }

        .call {
            background: #0d6efd;
            color: white;
        }

        /* INPUT */
        input {
            font-size: 22px;
            padding: 10px;
            width: 150px;
            text-align: center;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="left">
            <img src="gambar/logors.png" class="logo">
            <div>
                <div class="rs">RS Muhammadiyah Tuban</div>
                <div class="alamat">Jl Diponegoro No 1 Tuban</div>
            </div>
        </div>

        <div class="loket-title">
            LOKET <?php echo $loket ?>
        </div>
    </div>

    <div class="container">
        <div class="panel">

            <div class="nomor" id="nomor">
                <?php echo $nomor . " / " . $total ?>
            </div>

            <button class="prev" onclick="prev()">⬅ PREVIOUS</button>
            <button class="next" onclick="next()">NEXT ➜</button>

            <br><br>

            <input type="text" id="custom" placeholder="Nomor">
            <button class="call" onclick="custom()">PANGGIL</button>

        </div>
    </div>

    <script>
        var loket = <?php echo $loket ?>;

 // NEXT

 var loket = <?php echo $loket ?>;
var totalAntrian = <?php echo $total ?>;


function next(){

let nomorSekarang = document.getElementById("nomor").innerText.split("/")[0].trim();

fetch("next.php?loket=" + loket + "&sekarang=" + nomorSekarang)
.then(res => res.text())
.then(nomor => {

document.getElementById("nomor").innerText = nomor + " / " + totalAntrian;
speak(nomor, loket);

});

}

// PREVIOUS
function prev(){
    let nomorSekarang = document.getElementById("nomor").innerText.split("/")[0].trim();
    fetch("prev.php?loket="+loket+"&nomor="+nomorSekarang)
        .then(res=>res.text())
        .then(prevNomor=>{
            document.getElementById("nomor").innerText = prevNomor + " / " + <?php echo $total ?>;
            speak(prevNomor, loket);
        });
}

// CUSTOM
// CUSTOM
function custom(){
    let nomorInput = document.getElementById("custom").value.trim();
    if(nomorInput === "") return;

    // cek apakah nomor valid
    let totalAntrian = <?php echo $total ?>; // total antrian hari ini
    let nomorInt = parseInt(nomorInput);
    
    if(isNaN(nomorInt)){
        alert("Nomor tidak valid!");
        return;
    }

    if(nomorInt > totalAntrian){
        alert("Nomor terakhir hari ini adalah " + totalAntrian);
        return;
    }

    // jika valid, panggil nomor
    fetch("custom.php?loket="+loket+"&nomor="+nomorInt)
        .then(res => res.text())
        .then(data=>{
            document.getElementById("nomor").innerText = data + " / " + totalAntrian;
            speak(data, loket);
        });
}

    </script>

</body>

</html>