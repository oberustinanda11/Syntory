<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";

if (isset($_GET["id_transaksi_keluar"])) {
    if (!empty($_POST)) {
        $id_transaksi_keluar = isset($_POST["id_transaksi_keluar"]) ? $_POST["id_transaksi_keluar"] : $product["id_transaksi_keluar"];
        $nama_barang = isset($_POST["nama_barang"]) ? $_POST["nama_barang"] : $product["nama_barang"];
        $kode_barang = isset($_POST["kode_barang"]) ? $_POST["kode_barang"]: $product["kode_barang"];
        $qty_barang_keluar = isset($_POST["qty_barang_keluar"]) ? $_POST["qty_barang_keluar"] : $product["qty_barang_keluar"];
        $tanggal_keluar = isset($_POST["tanggal_keluar"]) ? $_POST["tanggal_keluar"] : $medicine["tanggal_keluar"];

        $stmt = $pdo->prepare(
            "UPDATE barang_keluar SET id_transaksi_keluar = ?, nama_barang = ?, kode_barang = ?, qty_barang_keluar = ?, tanggal_keluar = ? WHERE id_transaksi_keluar = ?"
        );
        $stmt->execute([
            $id_transaksi_keluar,
            $nama_barang,
            $kode_barang,
            $qty_barang_keluar,
            $tanggal_keluar,
            $_GET["id_transaksi_keluar"],
        ]);
        $msg = "Barang keluar berhasil diedit!";
    }

    $stmt = $pdo->prepare("SELECT * FROM barang_keluar WHERE id_transaksi_keluar = ?");
    $stmt->execute([$_GET["id_transaksi_keluar"]]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        exit("Barang masuk tidak ditemukan dengan ID tersebut!");
    }
} else {
    exit("ID tidak ditentukan!");
}
?>

<?= template_header("Update") ?>

<div class="content update">
    <h2>Edit Barang Keluar: <?= $product["nama_barang"] ?> - <?= $product["kode_barang"] ?></h2>
    <form action="update_barang_keluar.php?id_transaksi_keluar=<?= $product["id_transaksi_keluar"] ?>" method="post">
        <label for="id_transaksi_keluar">ID Transaksi Keluar</label>
        <input type="text" name="id_transaksi_keluar" id="id_transaksi_keluar" value="<?= $product[
            "id_transaksi_keluar"
        ] ?>">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" value="<?= $product[
            "nama_barang"
        ] ?>">
        <label for="kode_barang">Kode Barang</label>
        <input type="text" name="kode_barang" id="kode_barang" value="<?= $product[
            "kode_barang"
        ] ?>">
        <label for="qty_barang_keluar">Qty Barang Keluar</label>
        <input type="number" name="qty_barang_keluar" id="qty_barang_keluar" value="<?= $product[
            "qty_barang_keluar"
        ] ?>">
         <label for="tanggal_keluar">Tanggal Keluar</label>
        <input type="date" name="tanggal_keluar" id="tanggal_keluar" value="<?= $product[
            "tanggal_keluar"
        ] ?>">
        <input type="submit" value="Simpan">
    </form>
    <?php if ($msg): ?>
        <script>
            alert("<?php echo $msg; ?>");
            window.location.href = "read_barang_keluar.php";
        </script>
    <?php endif; ?>
</div>

