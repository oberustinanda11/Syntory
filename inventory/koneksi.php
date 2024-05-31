<?php
$host = "localhost"; // Nama host database
$username = "root"; // Username database
$password = ""; // Password database
$database = "inventory"; // Nama database

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>