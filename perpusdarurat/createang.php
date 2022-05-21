<?php
// Include config file
require_once "db.php";

// Define variables and initialize with empty values
$nama_anggota_err = $no_telpon_err = "";
$nama_anggota = $no_telpon = "";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {





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
        $sql = "INSERT INTO anggota (nama_anggota,no_telpon) VALUES (?,?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_nama_anggota, $param_no_telpon);

            // Set parameters
            $param_nama_anggota = $nama_anggota;
            $param_no_telpon = $no_telpon;


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: anggota.php");
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


                        <!-- Input nama anggota -->
                        <div class="form-floating mb-3 <?php echo (!empty($nama_anggota_err)) ? 'has-error' : ''; ?>">



                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Anggota"
                                name="nama_anggota">
                            <label for="floatingInput">Nama Anggota</label>


                            <span class="help-block"><?php echo $nama_anggota_err; ?></span>
                        </div>


                        <!-- Input nomor telepon -->
                        <div class="form-floating mb-3 <?php echo (!empty($no_telpon_err)) ? 'has-error' : ''; ?>">



                            <input type="tel" class="form-control" id="floatingInput" placeholder="Nomor Telepon"
                                name="no_telpon">
                            <label for="floatingInput">Nomor Telepon</label>


                            <span class="help-block"><?php echo $no_telpon_err; ?></span>
                        </div>
















                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="anggota.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>