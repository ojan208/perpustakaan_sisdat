<?php
// Include config file
require_once "db.php";

// Define variables and initialize with empty values
$id_anggota_err = $id_petugas_err = $id_buku_err = $tanggal_peminjaman_err = $tanggal_pengembalian_err = "";
$id_anggota = $id_petugas = $id_buku = $tanggal_peminjaman = $tanggal_pengembalian = "";

// Processing form data when form is submitted
if (isset($_POST["id_peminjaman"]) && !empty($_POST["id_peminjaman"])) {

    $id_peminjaman = $_GET["id_peminjaman"];

    //input id_petugas
    $input_id_petugas = trim($_POST["id_petugas"]);
    if ($input_id_petugas == "--Input id petugas--") {
        $id_petugas_err = "Masukkan Id Petugas !";
    } else {
        $id_petugas = $input_id_petugas;
    }

    //input id rak
    $input_id_anggota = trim($_POST["id_anggota"]);
    if ($input_id_anggota == "--Input id anggota--") {
        $id_anggota_err = "Masukkan Id Anggota !";
    } else {
        $id_anggota = $input_id_anggota;
    }

    //input genre
    $input_id_buku = trim($_POST["id_buku"]);
    if ($input_id_buku == "--Input id buku--") {
        $id_buku_err = "Masukkan Genre !";
    } else {
        $id_buku = $input_id_buku;
    }

    //input judul buku
    $input_tanggal_pinjam = trim($_POST["tanggal_peminjaman"]);
    if (empty($input_tanggal_pinjam)) {
        $tanggal_peminjaman_err = "Masukkan tanggal peminjaman!";
    } else {
        $tanggal_peminjaman = $input_tanggal_pinjam;
    }

    $input_tanggal_pengembalian = trim($_POST["tanggal_pengembalian"]);
    if (empty($input_tanggal_pengembalian)) {
        $tanggal_pengembalian_err = "Masukkan tanggal peminjaman!";
    } else {
        $tanggal_pengembalian = $input_tanggal_pengembalian;
    }




    // Check input errors before inserting in database
    if (empty($id_petugas_err) && empty($id_buku_err) && empty($id_anggota_err) && empty($tanggal_peminjaman_err) && empty($tanggal_pengembalian_err)) {
        // Prepare an insert statement
        $sql = "UPDATE peminjaman SET id_petugas=?,id_buku=?,id_anggota=?,tanggal_peminjaman=?,tanggal_pengembalian=? WHERE id_peminjaman=?";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi", $param_id_petugas, $param_id_buku, $param_id_anggota, $param_t_pinjam, $param_t_kembali, $param_id_pinjam);


            $sqlb4 = "SELECT id_rak FROM buku WHERE id_buku= $id_buku";
            $rakan = mysqli_query($db, $sqlb4);
            $data = mysqli_fetch_array($rakan);

            $param_id_petugas = $id_petugas;
            $param_id_buku = $id_buku;
            $param_id_anggota = $id_anggota;
            $param_t_pinjam = $tanggal_peminjaman;
            $param_t_kembali = $tanggal_pengembalian;
            $param_id_pinjam = $id_peminjaman;

            $sqlafter = "SELECT id_rak FROM buku WHERE id_buku= $param_id_buku";
            $rakan2 = mysqli_query($db, $sqlafter);
            $data2 = mysqli_fetch_array($rakan2);



            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                if ($data["id_rak"] != $data2["id_rak"]) {
                    $b4rak = $data["id_rak"];
                    $after = $data2["id_rak"];
                    $sqlr = "UPDATE rak set jumlah_buku= jumlah_buku + 1 WHERE id_rak = $after";
                    $sqlr2 = "UPDATE rak set jumlah_buku= jumlah_buku - 1 WHERE id_rak = $b4rak";
                    mysqli_query($db, $sqlr);
                    mysqli_query($db, $sqlr2);
                }
                header("location: pinjam.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
    // Check existence of id parameter before processing further
    if (isset($_GET["id_peminjaman"]) && !empty(trim($_GET["id_peminjaman"]))) {
        // Get URL parameter
        $id_peminjaman =  trim($_GET["id_peminjaman"]);

        // Prepare a select statement
        $sql = "SELECT * FROM peminjaman WHERE id_peminjaman = ?";
        if ($stmt = mysqli_prepare($db, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id_pinjam);

            // Set parameters
            $param_id_pinjam = $id_peminjaman;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                        contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $id_anggota = $row["id_anggota"];
                    $id_buku = $row["id_buku"];
                    $id_petugas = $row["id_petugas"];
                    $tanggal_peminjaman = $row["tanggal_peminjaman"];
                    $tanggal_pengembalian = $row["tanggal_pengembalian"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}

// Close connection



$sql2 = "SELECT * FROM petugas";
$hasil = mysqli_query($db, $sql2);

$sql3 = "SELECT * FROM buku";
$hasil2 = mysqli_query($db, $sql3);

$sqlg = "SELECT * FROM anggota";
$hasil3 = mysqli_query($db, $sqlg);
// Close connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
    .wrapper {
        width: 500px;
        margin: 0 auto;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand " href="adminpage.php" style="color:white;">
            <img src="img/book (1).png" width="30" height="30" class="d-inline-block align-top" alt="">
            Perpustakaan
        </a>

    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini kemudian submit untuk menambahkan data pegawai ke dalam
                        database.
                    </p>

                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post"
                        enctype="multipart/form-data">
                        <!-- Input id petugas -->

                        <div class="form-floating mb-3 <?php echo (!empty($id_petugas_err)) ? 'has-error' : ''; ?>">

                            <select class="form-select" aria-label="Default select example" name="id_petugas">
                                <option selected>--Input id petugas--</option>
                                <?php

                                while ($data = mysqli_fetch_array($hasil)) {
                                ?>
                                <option value="<?= $data['id_petugas'] ?>"><?= $data['id_petugas'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <label>Id Petugas</label>
                            <span class="help-block"><?php echo $id_petugas_err; ?></span>
                        </div>




                        <!-- Input id buku -->


                        <div class="form-floating mb-3 <?php echo (!empty($id_buku_err)) ? 'has-error' : ''; ?>">

                            <select class="form-select" aria-label="Default select example" name="id_buku">
                                <option selected>--Input id buku--</option>
                                <?php

                                while ($data = mysqli_fetch_array($hasil2)) {
                                ?>
                                <option value="<?= $data['id_buku'] ?>"><?= $data['id_buku'] ?></option>
                                <?php
                                }
                                ?>
                                <option selected="selected" value="<?php echo $id_buku ?>"><?php echo $id_buku ?>
                                </option>
                            </select>
                            <label>Id Buku</label>
                            <span class="help-block"><?php echo $id_buku_err; ?></span>
                        </div>

                        <!-- Input Id Anggota -->
                        <div class="form-floating mb-3 <?php echo (!empty($id_anggota_err)) ? 'has-error' : ''; ?>">

                            <select class="form-select" aria-label="Default select example" name="id_anggota">
                                <option selected>--Input id anggota--</option>
                                <?php

                                while ($data = mysqli_fetch_array($hasil3)) {
                                ?>
                                <option value="<?= $data['id_anggota'] ?>"><?= $data['id_anggota'] ?></option>
                                <?php
                                }
                                ?>
                                <option selected="selected" value="<?php echo $id_anggota ?>"><?php echo $id_anggota ?>
                                </option>
                            </select>
                            <label>Id anggota</label>
                            <span class="help-block"><?php echo $id_anggota_err; ?></span>
                        </div>




                        <!-- Input tanggal peminjaman -->
                        <div
                            class="form-floating mb-3 <?php echo (!empty($tanggal_peminjaman_err)) ? 'has-error' : ''; ?>">



                            <input type="date" class="form-control" placeholder="Tanggal Peminjaman"
                                name="tanggal_peminjaman" value="<?php echo $tanggal_peminjaman; ?>">
                            <label for="floatingInput">Tanggal Peminjaman</label>


                            <span class="help-block"><?php echo $tanggal_peminjaman_err; ?></span>
                        </div>


                        <!-- Input tanggal pengembalian -->
                        <div
                            class="form-floating mb-3 <?php echo (!empty($tanggal_pengembalian_err)) ? 'has-error' : ''; ?>">



                            <input type="date" class="form-control" placeholder="Tanggal Pengembalian"
                                name="tanggal_pengembalian" value="<?php echo $tanggal_pengembalian; ?>">
                            <label for="floatingInput">Tanggal Pengembalian</label>


                            <span class="help-block"><?php echo $tanggal_pengembalian_err; ?></span>
                        </div>







                        <input type="hidden" name="id_peminjaman" value="<?php echo $id_peminjaman; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="pinjam.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>