<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";

if (isset($_GET["id_supplier"])) {
    $stmt = $pdo->prepare("SELECT * FROM supplier WHERE id_supplier = ?");
    $stmt->execute([$_GET["id_supplier"]]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('tidak ada supplier dengan ID tersebut!');
    }
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            $stmt = $pdo->prepare("DELETE FROM supplier WHERE id_supplier = ?");
            $stmt->execute([$_GET["id_supplier"]]);
            $msg = "Supplier berhasil dihapus!";
        } else {
            header("Location: read_supplier.php");
            exit();
        }
    }
} else {
    exit("ID tidak ada!");
}
?>

<?= template_header("Delete") ?>

<div class="delete">
	<h2>Hapus Supplier</h2>
    <?php if ($msg): ?>
    <p><?= $msg ?></p>
    <div class="btn-confirm">
        <a href="read_supplier.php?">Kembali</a>
    </div>
    <?php else: ?>
	<p>Apakah kamu yakin ingin menghapus supplier <?= $product["nama_supplier"] ?>??</p>
    <div class="btn-confirm">
        <a href="delete_supplier.php?id_supplier=<?= $product["id_supplier"] ?>&confirm=yes">Iya</a>
        <a href="delete_supplier.php?id_supplier=<?= $product["id_supplier"] ?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>
