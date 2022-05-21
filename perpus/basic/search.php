<!-- page ini mirip ama page browse, jadi cssnya pake yang itu aja -->
<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan A</title>
    <link rel="stylesheet" type="text/css" href="css/browse.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@500&family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="nav-bar">
            <a href="http://localhost/perpus/landing.php" class="logo">[LOGO]</a>
            <ul class="nav-menu">
                <li>[SEARCH BAR]</li>
                <li>[LOGIN]</li>
            </ul>
        </div>
    </header>
    <div class="title">
        <h2>Ada [jumlah] hasil pencarian buku dengan kata kunci "[KATA KUNCI]"</h2>
    </div>
    <section class="list-buku">
        <p>Isinya buku buku yg dikotakin. Info yang dikasih judul sama penulis doang </p>
        <p>kotaknya kalau dipencet bakal ngarahin ke page buku tersebut</p>
    </section>

</body>
</html>