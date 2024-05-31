<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = "localhost";
    $DATABASE_USER = "root";
    $DATABASE_PASS = "";
    $DATABASE_NAME = "inventory";
    try {
        return new PDO(
            "mysql:host=" .
                $DATABASE_HOST .
                ";dbname=" .
                $DATABASE_NAME .
                ";charset=utf8",
            $DATABASE_USER,
            $DATABASE_PASS
        );
    } catch (PDOException $exception) {
        exit("Gagal koneksi database!");
    }
}
function template_header($title) {
    echo <<< EOT
    </body>
    </html>
    EOT;
    }
    ?>    

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inventory Sejutakado</title>
	<link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Inventory Sejutakado</h2>
        <ul>
            <li><a href="halaman.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="read_barang.php"><i class="fas fa-box-open"></i>Barang</a></li>
            <li><a href="read_barang_masuk.php"><i class="fas fa-level-down-alt"></i>Barang Masuk</a></li>
            <li><a href="read_barang_keluar.php"><i class="fas fa-level-up-alt"></i>Barang Keluar</a></li>
            <li><a href="read_supplier.php"><i class="fas fa-address-book"></i>Supplier</a></li>
        </ul> 
    </div>
<div class="main_content">
    <div class="header">Welcome!! Have a nice day.</div>  
</div>

</body>
</html>