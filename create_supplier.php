<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";


if (!empty($_POST)) {
    $id_supplier = isset($_POST["id_supplier"]) && $_POST["id_supplier"] !== "auto" ? $_POST["id_supplier"] :"";
    $nama_supplier = isset($_POST["nama_supplier"]) ? $_POST["nama_supplier"] : "";
    $barang_supply = isset($_POST["barang_supply"]) ? $_POST["barang_supply"] : "";
    $stmt = $pdo->prepare(
        "INSERT INTO supplier (id_supplier, nama_supplier, barang_supply) VALUES (?, ?, ?)"
    );
    $stmt->execute([
        $id_supplier, 
        $nama_supplier, 
        $barang_supply, 
    ]);

    $msg = "Supplier berhasil ditambahkan!";
}
?>

<?= template_header("Create") ?>

<div class="content update">
    <h2>Tambah Supplier</h2>
        <form action="create_supplier.php" method="post">
        <label for="id_supplier">ID Supplier</label>
        <input type="text" name="id_supplier" id="id_supplier">
        <label for="nama_supplier">Nama Supplier</label>
        <input type="text" name="nama_supplier" id="nama_supplier">
        <label for="barang_supply">Barang Supply</label>
        <input type="text" name="barang_supply" id="barang_supply">
        <input type="submit" value="Tambahkan">
    </form>
    <?php if ($msg): ?>
        <script>
            alert("<?php echo $msg; ?>");
            window.location.href = "read_supplier.php";
        </script>
    <?php endif; ?>
</div>
