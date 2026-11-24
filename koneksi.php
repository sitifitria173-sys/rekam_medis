<?php
$host = "localhost";
$user = "fitria";
$pass = "smkn3tbn";
$db   = "db_rekam_medis";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>