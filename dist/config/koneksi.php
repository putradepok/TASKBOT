<?php
$host = "localhost";
$user = "root";
$pass = "";      // isi kalau MySQL-mu pakai password
$db   = "db_taskbot1";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
