<?php
// Include config file
require_once "db.php";

// Define variables and initialize with empty values
$nama_anggota_err = $no_telpon_err = "";
$nama_anggota = $no_telpon = "";

// Processing form data when form is submitted
if (isset($_POST["id_anggota"]) && !empty($_POST["id_anggota"])) {

    $id_anggota = $_GET["id_anggota"];

    //input nama anggota
    $input_nama_anggota = trim($_POST["nama_anggota"]);
    if (empty($input_nama_anggota)) {
        $nama_anggota_err = "Masukkan nama anggota!";
    } elseif (!filter_var($input_nama_anggota, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nama_anggota_err = "Masukkan nama yang valid!";
    } else {
        $nama_anggota =   $input_nama_anggota;
    }

    //input no telepon
    $input_no_telp = trim($_POST["no_telpon"]);
    if (empty($input_no_telp)) {
        $no_telpon_err = "Masukkan nomor telepon !";
    } else {
        $no_telpon =  $input_no_telp;
    }



    // Check input errors before inserting in database
    if (empty($nama_anggota_err) && empty($no_telpon_err)) {
        // Prepare an insert statement
        $sql = "UPDATE anggota SET nama_anggota=?,no_telpon=? WHERE id_anggota=?";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_nama_anggota, $param_no_telpon, $param_id_anggota);

            // Set parameters
            $param_nama_anggota = $nama_anggota;
            $param_no_telpon = $no_telpon;
            $param_id_anggota = $id_anggota;




            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {


                header("location: anggota.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
    // Check existence of id parameter before processing further
    if (isset($_GET["id_anggota"]) && !empty(trim($_GET["id_anggota"]))) {
        // Get URL parameter
        $id_anggota =  trim($_GET["id_anggota"]);

        // Prepare a select statement
        $sql = "SELECT * FROM anggota WHERE id_anggota = ?";
        if ($stmt = mysqli_prepare($db, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id_anggota);

            // Set parameters
            $param_id_anggota = $id_anggota;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                        contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $nama_anggota = $row["nama_anggota"];
                    $no_telpon = $row["no_telpon"];
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

                        <!-- Input nama anggota -->
                        <div class="form-floating mb-3 <?php echo (!empty($nama_anggota_err)) ? 'has-error' : ''; ?>">



                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Anggota"
                                name="nama_anggota" value="<?php echo $nama_anggota; ?>">
                            <label for="floatingInput">Nama Anggota</label>


                            <span class="help-block"><?php echo $nama_anggota_err; ?></span>
                        </div>


                        <!-- Input nomor telepon -->
                        <div class="form-floating mb-3 <?php echo (!empty($no_telpon_err)) ? 'has-error' : ''; ?>">



                            <input type="tel" class="form-control" id="floatingInput" placeholder="Nomor Telepon"
                                name="no_telpon" value="<?php echo $no_telpon; ?>">
                            <label for="floatingInput">Nomor Telepon</label>


                            <span class="help-block"><?php echo $no_telpon_err; ?></span>
                        </div>













                        <input type="hidden" name="id_anggota" value="<?php echo $id_anggota; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="anggota.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>