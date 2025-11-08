<?php
$host = "127.0.0.1:3307";
$user = "root";
$pass = "";
$db   = "db_sd_maccinisombala1";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
