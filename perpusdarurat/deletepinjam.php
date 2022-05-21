<?php
// Process delete operation after confirmation
if (isset($_POST["id_peminjaman"]) && !empty($_POST["id_peminjaman"])) {
    // Include config file
    require_once "db.php";

    // Prepare a delete statement
    $sql = "DELETE FROM peminjaman WHERE id_peminjaman = ?";

    if ($stmt = mysqli_prepare($db, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_POST["id_peminjaman"]);

        $sqlb4 = "SELECT id_rak FROM rak WHERE id_rak= ANY(SELECT id_rak from BUKU where id_buku=ANY(SELECT id_buku from  peminjaman WHERE id_peminjaman=$param_id))";
        $rakan = mysqli_query($db, $sqlb4);
        $data = mysqli_fetch_array($rakan);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records deleted successfully. Redirect to landing page
            $bukuan = $data["id_rak"];

            $sqlr2 = "UPDATE rak set jumlah_buku= jumlah_buku + 1 WHERE id_rak = $bukuan";
            mysqli_query($db, $sqlr2);
            header("location: pinjam.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($db);
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["id_peminjaman"]))) {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    .wrapper {
        width: 500px;
        margin: 0 auto;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id_peminjaman"
                                value="<?php echo trim($_GET["id_peminjaman"]); ?>" />
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="pinjam.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>