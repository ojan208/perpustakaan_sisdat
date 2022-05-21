<?php
$server = "localhost";
$user = "root";
$port = "3306";
$password = "";
$nama_database = "perpustakaan";

$db = mysqli_connect($server, $user, $password, $nama_database);

if (!$db) {
    die("Gagal terhubung dengan database :" . mysqli_connect_error());
}