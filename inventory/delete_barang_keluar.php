<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";

if (isset($_GET["id_transaksi_keluar"])) {
    $stmt = $pdo->prepare("SELECT * FROM barang_keluar WHERE id_transaksi_keluar = ?");
    $stmt->execute([$_GET["id_transaksi_keluar"]]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('tidak ada supplier dengan ID tersebut!');
    }
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            $stmt = $pdo->prepare("DELETE FROM barang_keluar WHERE id_transaksi_keluar = ?");
            $stmt->execute([$_GET["id_transaksi_keluar"]]);
            $msg = "Barang keluar berhasil dihapus!";
        } else {
            header("Location: read_barang_keluar.php");
            exit();
        }
    }
} else {
    exit("ID tidak ada!");
}
?>

<?= template_header("Delete") ?>

<div class="delete">
	<h2>Hapus Barang Keluar</h2>
    <?php if ($msg): ?>
    <p><?= $msg ?></p>
    <div class="btn-confirm">
        <a href="read_barang_keluar.php?">Kembali</a>
    </div>
    <?php else: ?>
	<p>Apakah kamu yakin ingin menghapus barang <?= $product["nama_barang"] ?> - <?= $product[
     "kode_barang"
 ] ?>??</p>
    <div class="btn-confirm">
        <a href="delete_barang_keluar.php?id_transaksi_keluar=<?= $product["id_transaksi_keluar"] ?>&confirm=yes">Iya</a>
        <a href="delete_barang_keluar.php?id_transaksi_keluar=<?= $product["id_transaksi_keluar"] ?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>
