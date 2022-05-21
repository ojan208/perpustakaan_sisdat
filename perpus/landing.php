<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan A</title>
    <link rel="stylesheet" type="text/css" href="css/landing.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Overpass:wght@500&family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <!-- ini buat header nya -->
    <?php
    include 'headerLand.php';
    ?>

    
     <div class="container">
         <div class="welcome">
           <div class="welcome-box">
                <div class="pad">
                    <center><h3>SELAMAT DATANG DI PERPUSTAKAAN A</h3></center>
                    <center><p class="quote">"I have always imagined that Paradise will be a kind of a Library."</p></center>
                    <center><p class="famous-person">-- Jorge Luis Borges --</p></center>
                </div>
           </div>
         </div>

         <section class="katalog">
           <h1><center>Katalog Buku</center></h1>
           <p></p>
           <div class="list-kategori">
               <a href="basic/browse.php?genre=SEMUA" class="box-kategori">
                   <div class="ikon-kat">
                        <img src="ikon/all.png" alt="" width=60 height=auto>
                        <h5>SEMUA</h5>
                   </div>
               </a>
               <?php
                include 'db.php';
                $genreEnum = mysqli_query($conn, "SELECT SUBSTRING(COLUMN_TYPE,5) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'perpusa' AND TABLE_NAME = 'buku' AND COLUMN_NAME = 'genre'");
                $namaGenreEnum = $genreEnum->fetch_array()[0] ?? '';
                $namaGenreEnum = str_replace("'", "", $namaGenreEnum);
                $namaGenreEnum = substr($namaGenreEnum, 1, -1);
                $namaGenreArr = explode(',', $namaGenreEnum);

                foreach($namaGenreArr as $namaGenre)
                { ?>
                    <a href="basic/browse.php?genre=<?php echo $namaGenre?>" class="box-kategori">
                        <div class="ikon-kat">
                            <img src="ikon/<?php echo $namaGenre?>.png" alt="" width=60 height=auto>
                            <h5><?php echo $namaGenre ?></h5>
                        </div>
                    </a>
                <?php }
               ?>
           </div>
         </section>
     </div>
</body>
</html>