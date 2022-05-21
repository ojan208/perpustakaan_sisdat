<?php
// Process delete operation after confirmation
if (isset($_POST["id_buku"]) && !empty($_POST["id_buku"])) {
    // Include config file
    require_once "db.php";

    // Prepare a delete statement
    $sql = "DELETE FROM buku WHERE id_buku = ?";

    if ($stmt = mysqli_prepare($db, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_POST["id_buku"]);
        $sqldelsampul = "SELECT sampul FROM BUKU  WHERE id_buku=$param_id";
        $delsampul = mysqli_query($db, $sqldelsampul);
        $row = mysqli_fetch_array($delsampul);



        unlink("./sampul/" . $row["sampul"]);


        // Attempt to execute the prepared statement
        $sqldelbukrak = "UPDATE rak set jumlah_buku= jumlah_buku - 1 WHERE id_rak = any(SELECT id_rak from buku WHERE id_buku = $param_id)";
        mysqli_query($db, $sqldelbukrak);
        if (mysqli_stmt_execute($stmt)) {
            header("location: adminpage.php");
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
    if (empty(trim($_GET["id_buku"]))) {
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
                            <input type="hidden" name="id_buku" value="<?php echo trim($_GET["id_buku"]); ?>" />
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="adminpage.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>