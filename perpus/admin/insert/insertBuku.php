<?php
include '../../db.php';
session_start();

if(isset($_POST['insertBuku']))
{
    $filename =$_FILES['sampul']['tmp_name'];
    $id_petugas = $_SESSION['id'];
    $cover = $_FILES['sampul']['name'];
    $Judul = $_POST['Judul'];
    $Penulis = $_POST['Penulis'];
    $Penerbit = $_POST['Penerbit'];
    $Genre = $_POST['Genre'];
    $Lokasi = $_POST['Lokasi'];

    $query = "INSERT INTO buku VALUES (NULL, '".$Judul."', '".$Penulis."', 
            '".$Penerbit."', '".$cover."', '".$Genre."', '".$id_petugas."', '".$Lokasi."')";
    $run_query = mysqli_query($conn, $query);

    if($run_query)
    {
        move_uploaded_file($filename, "../../sampul/".$cover);
        echo '<script> alert("Buku Berhasil Ditambahkan!")</script>';
        header('Location: ../dashboard.php');
    }
    else {
        echo '<script> alert("Pendaftaran gagal!")</script>';
    }
}
?>
