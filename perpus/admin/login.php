<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Perpus A</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Overpass:wght@500&family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
    <?php
    include '../header.php';
    session_start();
    ?>
        <div class="box-login">
            <h2>Login Admin</h2>
            <form action="" method="POST">
                <input type="text" name="user" placeholder="Username" class="input-control">
                <input type="password" name="pass" placeholder="Password" class="input-control">
                <br>
                <input type="submit" name="submit" value="login" class="login-button">
            </form>
            <?php
                if(isset($_POST['submit']))
                {
                    include '../db.php';
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];

                    $cek = mysqli_query($conn, "SELECT petugas.nama, petugas.id AS id_admin FROM petugas 
                                        LEFT JOIN info_login ON info_login.id_petugas = petugas.id
                                        WHERE username = '".$user."' AND password = '".$pass."'");
                    if (mysqli_num_rows($cek)) 
                    {
                        $d = mysqli_fetch_object($cek);
                        $_SESSION['status_login'] = true;
                        $_SESSION['a_global'] = $d;
                        $_SESSION['id'] = $d->id_admin;
                        echo '<script>window.location="dashboard.php"</script>';
                    }
                    else 
                    {
                        echo '<script>alert("Username atau Password anda salah!")</script>';
                    }
                }
            ?>
        </div>
    </body>
</html>
