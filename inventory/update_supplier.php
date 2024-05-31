<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";

if (isset($_GET["id_supplier"])) {
    if (!empty($_POST)) {
        $id_supplier = isset($_POST["id_supplier"]) ? $_POST["id_supplier"] : $product["id_supplier"];
        $nama_supplier = isset($_POST["nama_supplier"]) ? $_POST["nama_supplier"] : $product["nama_supplier"];
        $barang_supply = isset($_POST["barang_supply"]) ? $_POST["barang_supply"]: $product["barang_supply"];

        $stmt = $pdo->prepare(
            "UPDATE supplier SET id_supplier = ?, nama_supplier = ?, barang_supply = ? WHERE id_supplier = ?"
        );
        $stmt->execute([
            $id_supplier,
            $nama_supplier,
            $barang_supply,
            $_GET["id_supplier"],
        ]);
        $msg = "Supplier berhasil diedit!";
    }

    $stmt = $pdo->prepare("SELECT * FROM supplier WHERE id_supplier = ?");
    $stmt->execute([$_GET["id_supplier"]]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        exit("Supplier tidak ditemukan dengan ID tersebut!");
    }
} else {
    exit("ID tidak ditentukan!");
}
?>

<?= template_header("Update") ?>

<div class="content update">
    <h2>Edit Supplier: <?= $product["nama_supplier"] ?></h2>
    <form action="update_supplier.php?id_supplier=<?= $product["id_supplier"] ?>" method="post">
        <label for="id_supplier">ID Supplier</label>
        <input type="text" name="id_supplier" id="id_supplier" value="<?= $product[
            "id_supplier"
        ] ?>">
        <label for="nama_supplier">Nama Supplier</label>
        <input type="text" name="nama_supplier" id="nama_supplier" value="<?= $product[
            "nama_supplier"
        ] ?>">
        <label for="barang_supply">Barang Supply</label>
        <input type="text" name="barang_supply" id="barang_supply" value="<?= $product[
            "barang_supply"
            ] ?>">
        <input type="submit" value="Simpan">
    </form>
    <?php if ($msg): ?>
        <script>
            alert("<?php echo $msg; ?>");
            window.location.href = "read_supplier.php";
        </script>
    <?php endif; ?>
</div>

