<?php
include '../../db.php';
session_start();

if(isset($_POST['insertPinjam']))
{
    $id_buku = $_POST['buku'];
    $id_anggota = $_POST['anggota'];
    $id_petugas = $_SESSION['id'];
    $today = date("y-m-d");
    $dua_date = mktime($today, date("m")  , date("d")+7, date("Y"));;

    $query = "INSERT INTO peminjaman VALUES (NULL, '".$id_buku."', '".$id_petugas."', 
            '".$id_anggota."', '".$today."', '".$dua_date."')";
    $run_query = mysqli_query($conn, $query);

    if($run_query)
    {
        echo '<script> alert("Data Peminjaman Berhasil Disimpan!")</script>';
        header('Location: ../dashboard.php');
    }
    else {
        echo '<script> alert("Pendaftaran gagal!")</script>';
    }
}
?>