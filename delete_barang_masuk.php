<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";

if (isset($_GET["id_transaksi_masuk"])) {
    $stmt = $pdo->prepare("SELECT * FROM barang_masuk WHERE id_transaksi_masuk = ?");
    $stmt->execute([$_GET["id_transaksi_masuk"]]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('tidak ada barang masuk dengan ID tersebut!');
    }
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            $stmt = $pdo->prepare("DELETE FROM barang_masuk WHERE id_transaksi_masuk = ?");
            $stmt->execute([$_GET["id_transaksi_masuk"]]);
            $msg = "Barang masuk berhasil dihapus!";
        } else {
            header("Location: read_barang_masuk.php");
            exit();
        }
    }
} else {
    exit("ID tidak ada!");
}
?>

<?= template_header("Delete") ?>

<div class="delete">
	<h2>Hapus Barang Masuk</h2>
    <?php if ($msg): ?>
    <p><?= $msg ?></p>
    <div class="btn-confirm">
        <a href="read_barang_masuk.php?">Kembali</a>
    </div>
    <?php else: ?>
	<p>Apakah kamu yakin ingin menghapus barang <?= $product["nama_barang"] ?> - <?= $product[
     "kode_barang"
 ] ?>??</p>
    <div class="btn-confirm">
        <a href="delete_barang_masuk.php?id_transaksi_masuk=<?= $product["id_transaksi_masuk"] ?>&confirm=yes">Iya</a>
        <a href="delete_barang_masuk.php?id_transaksi_masuk=<?= $product["id_transaksi_masuk"] ?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>
