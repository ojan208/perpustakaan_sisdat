<?php
include '../../db.php';

if(isset($_POST['insertAng']))
{
    $nama = $_POST['Nama'];
    $noTelp = $_POST['noTelp'];

    $query = "INSERT INTO anggota VALUES (NULL, '".$nama."', '".$noTelp."');";
    $run_query = mysqli_query($conn, $query);

    if($run_query)
    {
        echo '<script> alert("Anggota Berhasil Didaftarkan!")</script>';
        header('Location: ../../dashboard.php');
    }
    else {
        echo '<script> alert("Pendaftaran gagal!")</script>';
    }
}
?>
