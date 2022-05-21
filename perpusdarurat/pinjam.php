<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Buku</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand " href="adminpage.php" style="color:white;">
            <img src="img/book (1).png" width="30" height="30" class="d-inline-block align-top" alt="">
            Perpustakaan
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" style="color:white;" href="
                    adminpage.php">Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:white;" href="
                    pinjam.php">Peminjaman</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" style="color:white;" href="anggota.php">Anggota</a>
                </li>
            </ul>
        </div>

        <a href="home.php" class="btn btn-light btn-lg" role="button" aria-pressed="true">Logout
            Admin</a>


    </nav>


    <!--Table-->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left" style="text-align:center;">Informasi Peminjaman</h2>
                        <div class="row g-3">
                            <div class="col">
                                <a href="createpinjam.php" class="btn btn-success ">Tambah Baru</a>
                            </div>
                            <div class="col" style="margin-left:829px;">
                                <div class="input-group mb-3" style="width:350px;">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="button-addon1">Pencarian</button>
                                    <input type="text" class="form-control" placeholder="Masukkan nama judul"
                                        aria-label="Example text with button addon" aria-describedby="button-addon1">
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                    // Include config file
                    require_once "db.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM peminjaman";
                    if ($result = mysqli_query($db, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table class='table table-bordered border-dark table-striped'>";
                            echo "<thead class='table-dark'>";
                            echo "<tr>";
                            echo "<th>Id Peminjaman</th>";
                            echo "<th>Id Anggota</th>";
                            echo "<th>Id Petugas yang meminjamkan</th>";
                            echo "<th>Id Buku</th>";
                            echo "<th>Tanggal Peminjaman</th>";
                            echo "<th>Tanggal Pengembalian</th>";
                            echo "<th>Pengaturan</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td> " . $row['id_peminjaman'] . "</td>";
                                echo "<td>" . $row['id_anggota'] . "</td>";
                                echo "<td>" . $row['id_petugas'] . "</td>";
                                echo "<td>" . $row['id_buku'] . "</td>";
                                echo "<td>" . $row['tanggal_peminjaman'] . "</td>";
                                echo "<td>" . $row['tanggal_pengembalian'] . "</td>";
                                echo "<td>";
                                echo "<a href='updatepinjam.php?id_peminjaman=" . $row['id_peminjaman'] . "' class='btn btn-primary pull-right'>Edit </a>";
                                echo "<a href='deletepinjam.php?id_peminjaman=" . $row['id_peminjaman'] . "'  class='btn btn-danger mx-3  pull-right'>Delete </a>";

                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                    }

                    // Close connection
                    mysqli_close($db);
                    ?>
                </div>
            </div>
        </div>
    </div>






</body>