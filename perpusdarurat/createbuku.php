<?php
// Include config file
require_once "db.php";

// Define variables and initialize with empty values
$id_petugas_err = $id_rak_err = $genre_err = $judul_buku_err = $nama_penulis_err = $nama_penerbit_err = "";
$sampul_err = "";
$id_petugas = $id_rak = $genre = $judul_buku = $nama_penulis = $nama_penerbit = "";
$sampul = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {



    //input id_petugas
    $input_id_petugas = trim($_POST["id_petugas"]);
    if ($input_id_petugas == "--Input id petugas--") {
        $id_petugas_err = "Masukkan Id Petugas !";
    } else {
        $id_petugas = $input_id_petugas;
    }

    //input id rak
    $input_id_rak = trim($_POST["id_rak"]);
    if ($input_id_rak == "--Input id rak--") {
        $id_rak_err = "Masukkan Id Rak !";
    } else {
        $id_rak = $input_id_rak;
    }

    //input genre
    $input_genre = trim($_POST["genre"]);
    if ($input_genre == "--Input genre--") {
        $genre_err = "Masukkan Genre !";
    } else {
        $genre = $input_genre;
    }

    //input judul buku
    $input_judul = trim($_POST["judul_buku"]);
    if (empty($input_judul)) {
        $judul_buku_err = "Masukkan judul buku!";
    } else {
        $judul_buku = $input_judul;
    }

    //input nama penulis
    $input_penulis = trim($_POST["nama_penulis"]);
    if (empty($input_penulis)) {
        $nama_penulis_err = "Masukkan nama penulis!";
    } elseif (!filter_var($input_penulis, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nama_penulis_err = "Masukkan nama yang valid!";
    } else {
        $nama_penulis = $input_penulis;
    }

    //input nama penerbit
    $input_penerbit = trim($_POST["nama_penerbit"]);
    if (empty($input_penerbit)) {
        $nama_penerbit_err = "Masukkan nama penerbit!";
    } elseif (!filter_var($input_penerbit, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nama_penerbit_err = "Masukkan nama yang valid!";
    } else {
        $nama_penerbit = $input_penerbit;
    }

    //input gambar
    $input_sampul = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $x = explode('.', $input_sampul);
    $eks = strtolower(end($x));
    $ekstensi = array('png', 'jpg', 'jpeg');
    $ext = pathinfo($input_sampul, PATHINFO_EXTENSION);
    if (in_array($eks, $ekstensi) == FALSE) {
        $sampul_err = "Masukkan Gambar !";
    } else if ($ukuran > 1044070) {
        $sampul_err = "File terlalu Besar!";
    } else if ($input_sampul == "") {
        $sampul_err = "Masukkan sampul !";
    } else {
        $sampul = $input_sampul;
    }



    // Check input errors before inserting in database
    if (empty($id_petugas_err) && empty($id_rak_err) && empty($genre_err) && empty($genre_err) && empty($sampul_err) && empty($judul_buku_err) && empty($nama_penerbit_err) && empty($nama_penulis_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO buku (id_petugas,id_rak,genre,sampul,judul_buku,nama_penulis,nama_penerbit) VALUES (?,?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_id_petugas, $param_id_rak, $param_genre, $param_sampul, $param_judul, $param_penulis, $param_penerbit);

            // Set parameters
            $param_id_petugas = $id_petugas;
            $param_id_rak = $id_rak;
            $param_genre = $genre;
            $param_sampul = $sampul;
            $param_judul = $judul_buku;
            $param_penulis = $nama_penulis;
            $param_penerbit = $nama_penerbit;

            //memindahkan gambar ke folder xampp
            $folder = './sampul/';
            $sumber = $_FILES["foto"]["tmp_name"];
            move_uploaded_file($sumber, $folder . $param_sampul);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {


                $sqlr = "UPDATE rak set jumlah_buku= jumlah_buku + 1 WHERE id_rak = $param_id_rak";
                mysqli_query($db, $sqlr);
                header("location: adminpage.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection

}
$sql2 = "SELECT * FROM petugas";
$hasil = mysqli_query($db, $sql2);

$sql3 = "SELECT * FROM rak";
$hasil2 = mysqli_query($db, $sql3);
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
                        <h2>Tambah Record</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini kemudian submit untuk menambahkan data pegawai ke dalam
                        database.
                    </p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
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




                        <!-- Input id rak -->


                        <div class="form-floating mb-3 <?php echo (!empty($id_rak_err)) ? 'has-error' : ''; ?>">

                            <select class="form-select" aria-label="Default select example" name="id_rak">
                                <option selected>--Input id rak--</option>
                                <?php

                                while ($data = mysqli_fetch_array($hasil2)) {
                                ?>
                                <option value="<?= $data['id_rak'] ?>"><?= $data['id_rak'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <label>Id Rak</label>
                            <span class="help-block"><?php echo $id_rak_err; ?></span>
                        </div>

                        <!-- Input Genre -->


                        <div class="form-floating mb-3 <?php echo (!empty($genre_err)) ? 'has-error' : ''; ?>">

                            <select class="form-select" aria-label="Default select example" name="genre"
                                style='width:"100px";'>
                                <option selected>--Input genre--</option>

                                <option value="Fantasy">Fantasy</option>
                                <option value="History">History</option>
                                <option value="Education">Education</option>
                                <option value="Comedy">Comedy</option>
                                <option value="Romance">Romance</option>



                            </select>
                            <label>Genre</label>
                            <span class="help-block"><?php echo $genre_err; ?></span>
                        </div>

                        <!-- Input judul -->
                        <div class="form-floating mb-3 <?php echo (!empty($judul_buku_err)) ? 'has-error' : ''; ?>">



                            <input type="text" class="form-control" id="floatingInput" placeholder="Judul Buku"
                                name="judul_buku">
                            <label for="floatingInput">Judul Buku</label>


                            <span class="help-block"><?php echo $judul_buku_err; ?></span>
                        </div>


                        <!-- Input nama penulis -->
                        <div class="form-floating mb-3 <?php echo (!empty($nama_penulis_err)) ? 'has-error' : ''; ?>">



                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Penulis"
                                name="nama_penulis">
                            <label for="floatingInput">Nama Penulis</label>


                            <span class="help-block"><?php echo $nama_penulis_err; ?></span>
                        </div>

                        <!-- Input nama penerbit -->
                        <div class="form-floating mb-3 <?php echo (!empty($nama_penerbit_err)) ? 'has-error' : ''; ?>">



                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Penerbit"
                                name="nama_penerbit">
                            <label for="floatingInput">Nama Penerbit</label>


                            <span class="help-block"><?php echo $nama_penerbit_err; ?></span>
                        </div>





                        <!-- Input sampul -->
                        <div class="form-group mb-3 <?php echo (!empty($sampul_err)) ? 'has-error' : ''; ?>">


                            <label for="input-group-text">Gambar Sampul</label>
                            <div class="input-group">
                                <input type="file" name="foto" class="form-control" id="foto">
                            </div>

                            <span class="help-block"><?php echo $sampul_err; ?></span>
                        </div>









                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="adminpage.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>