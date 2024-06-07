<?php
include "fungsi.php";
$conn = mysqli_connect("localhost", "root", "", "inventory");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$id_user = isset($_POST["id_user"]) ? $_POST["id_user"] : "";
$sandi = isset($_POST["sandi"]) ? $_POST["sandi"] : "";

$sql = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$id_user' AND sandi = '$sandi'") or die(mysqli_error($conn));

if (mysqli_num_rows($sql) == 0) {
    echo '<script language="javascript">
    alert("ID user dan password salah! Silahkan login kembali.");
    window.location.href = "login.php";
    </script>';
} else {
    echo '<script language="javascript">
    alert("Anda berhasil login!");
    window.location.href = "halaman.php";
    </script>';
}
?>
