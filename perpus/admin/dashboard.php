<?php
session_start();
if($_SESSION['status_login'] != true)
{
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../css/dashboard.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/tabel.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Perpus A</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Overpass:wght@500&family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <script src="dash-script.js" defer></script>
</head>
<body>
    <?php
    // session_start();
    include '../header.php';
    ?>
    <div class="welcome-petugas">
        <h3>Dashboard</h3>
        <div class="halo-box">
            <div class="halo">
                <h3>Halo, <?php echo $_SESSION['a_global']->nama ?></h3>
                <p>Jangan lupa untuk logout bila shift anda selesai!</p>
            </div>
            <div class="logout">
                
            </div>
        </div>
    </div>

    <ul class="tabs">
        <li data-tab-target="#data-buku" class="active tab">Data Buku</li>
        <li data-tab-target="#pinjam" class="tab">Peminjaman</li>
        <li data-tab-target="#anggota" class="tab">Anggota Terdaftar</li>
    </ul>

    <div class="tab-content">
        <div id="data-buku" data-tab-content class="active">
            <div class="title">
                <h2>Data Buku</h2>
            </div>
            <?php include 'data-buku.php'; ?>
        </div>
        <div id="pinjam" data-tab-content>
            <div class="title">
                <h2>Peminjaman</h2>
            </div>
            <?php include 'data-pinjam.php';?>
        </div>
        <div id="anggota" data-tab-content>
            <div class="title">
                <h2>Anggota Terdaftar</h2>
            </div>
            <?php include 'data-anggota.php'; ?>
        </div>
    </div>
</body>
</html>