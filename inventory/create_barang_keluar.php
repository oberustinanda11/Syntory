<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";


if (!empty($_POST)) {
    $id_transaksi_keluar = isset($_POST["id_transaksi_keluar"]) && $_POST["id_transaksi_keluar"] !== "auto" ? $_POST["id_transaksi_keluar"] :"";
    $nama_barang = isset($_POST["nama_barang"]) ? $_POST["nama_barang"] : "";
    $kode_barang = isset($_POST["kode_barang"]) ? $_POST["kode_barang"] : "";
    $qty_barang_keluar = isset($_POST["qty_barang_keluar"]) ? $_POST["qty_barang_keluar"] : 0;
    $tanggal_keluar = isset($_POST["tanggal_keluar"])
        ? $_POST["tanggal_keluar"]
        : "0000-00-00 00:00:00";
    $stmt = $pdo->prepare(
        "INSERT INTO barang_keluar (id_transaksi_keluar, nama_barang, kode_barang, qty_barang_keluar, tanggal_keluar) VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $id_transaksi_keluar, 
        $nama_barang, 
        $kode_barang, 
        $qty_barang_keluar, 
        $tanggal_keluar
    ]);

    $msg = "Transaksi keluar berhasil ditambahkan!";
}
?>

<?= template_header("Create") ?>

<div class="content update">
    <h2>Tambah Barang</h2>
        <form action="create_barang_keluar.php" method="post">
        <label for="id_transaksi_keluar">ID Transaksi keluar</label>
        <input type="text" name="id_transaksi_keluar" id="id_transaksi_keluar">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang">
        <label for="kode_barang">Kode Barang</label>
        <input type="text" name="kode_barang" id="kode_barang">
        <label for="qty_barang_keluar">Qty Barang Keluar</label>
        <input type="number" name="qty_barang_keluar" id="qty_barang_keluar">
        <label for="tanggal_keluar">Tanggal Keluar</label>
        <input type="date" name="tanggal_keluar" id="tanggal_keluar">
        <input type="submit" value="Tambahkan">
    </form>
    <?php if ($msg): ?>
        <script>
            alert("<?php echo $msg; ?>");
            window.location.href = "read_barang_keluar.php";
        </script>
    <?php endif; ?>
</div>
