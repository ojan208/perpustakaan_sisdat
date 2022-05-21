<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan A</title>
    <link rel="stylesheet" type="text/css" href="../css/browse.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Overpass:wght@500&family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Ini buat header nya -->
    <?php
    include '../header.php';
    ?>

    <?php
        include '../db.php';
        $genre = $_GET['genre'];
        // $namaGenre = mysqli_query($conn, "SELECT * FROM genre WHERE id = $genre");

        if ($genre == 'SEMUA')
        {
            $bukuArr = mysqli_query($conn, "SELECT * FROM buku");
        }
        else
        {
            $bukuArr = mysqli_query($conn, "SELECT * FROM buku WHERE genre = '".$genre."'");
        }
    ?>

    <div class="container">
        <div class="title">
            <h2>Katalog Buku: <?php echo $genre ?></h2>
            <p>Terdapat <?php echo mysqli_num_rows($bukuArr) ?> buku dari katalog yang dipilih</p>
        </div>
        <div class="list-buku">
            <?php
            if(mysqli_num_rows($bukuArr) > 0) {
                while($dataBuku = mysqli_fetch_array($bukuArr)) {
            ?>
            <a href="book.php?id_buku=<?php echo $dataBuku['id']?>" class="box-buku">
                <div class="info-buku">
                    <div class="sampul">
                        <img src="../sampul/<?php echo $dataBuku['cover']?>">
                    </div>
                    <div class="detail">
                        <p><?php echo $dataBuku['penulis'] ?></p>
                        <h3><?php echo $dataBuku['judul'] ?></h3>
                    </div>
                </div>
            </a>
            <?php }} else{?>
                <h2>Tidak ada buku dalam genre ini</h2>
            <?php } ?>
        </div>
    </div>

</body>
</html>