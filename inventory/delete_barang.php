<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";

if (isset($_GET["kode_barang"])) {
    $stmt = $pdo->prepare("SELECT * FROM barang WHERE kode_barang = ?");
    $stmt->execute([$_GET["kode_barang"]]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('tidak ada obat dengan ID tersebut!');
    }
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            $stmt = $pdo->prepare("DELETE FROM barang WHERE kode_barang = ?");
            $stmt->execute([$_GET["kode_barang"]]);
            $msg = "Barang berhasil dihapus!";
        } else {
            header("Location: read_barang.php");
            exit();
        }
    }
} else {
    exit("ID tidak ada!");
}
?>

<?= template_header("Delete") ?>

<div class="delete">
	<h2>Hapus Barang</h2>
    <?php if ($msg): ?>
    <p><?= $msg ?></p>
    <div class="btn-confirm">
        <a href="read_barang.php?">Kembali</a>
    </div>
    <?php else: ?>
	<p>Apakah kamu yakin ingin menghapus barang <?= $product["nama_barang"] ?> - <?= $product[
     "jenis_barang"
 ] ?>??</p>
    <div class="btn-confirm">
        <a href="delete_barang.php?kode_barang=<?= $product["kode_barang"] ?>&confirm=yes">Iya</a>
        <a href="delete_barang.php?kode_barang=<?= $product["kode_barang"] ?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>
