<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";


if (!empty($_POST)) {
    $id_transaksi_masuk = isset($_POST["id_transaksi_masuk"]) && $_POST["id_transaksi_masuk"] !== "auto" ? $_POST["id_transaksi_masuk"] : null ;
    $nama_barang = isset($_POST["nama_barang"]) ? $_POST["nama_barang"] : "";
    $kode_barang = isset($_POST["kode_barang"]) ? $_POST["kode_barang"] : "";
    $qty_barang_masuk = isset($_POST["qty_barang_masuk"]) ? $_POST["qty_barang_masuk"] : 0;
    $id_supplier = isset($_POST["id_supplier"]) ? $_POST["id_supplier"] : "";
    $tanggal_masuk = isset($_POST["tanggal_masuk"])
        ? $_POST["tanggal_masuk"]
        : "0000-00-00 00:00:00";
    $stmt = $pdo->prepare(
        "INSERT INTO barang_masuk (id_transaksi_masuk, nama_barang, kode_barang, qty_barang_masuk, id_supplier, tanggal_masuk) VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $id_transaksi_masuk, 
        $nama_barang, 
        $kode_barang, 
        $qty_barang_masuk, 
        $id_supplier, 
        $tanggal_masuk
    ]);

    $msg = "transaksi masuk berhasil ditambahkan!";
}
?>

<?= template_header("Create") ?>

<div class="content update">
    <h2>Tambah Barang Masuk</h2>
        <form action="create_barang_masuk.php" method="post">
        <label for="id_transaksi_masuk">ID Transaksi Masuk</label>
        <input type="text" name="id_transaksi_masuk" id="id_transaksi_masuk">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang">
        <label for="kode_barang">Kode Barang</label>
        <input type="text" name="kode_barang" id="kode_barang">
        <label for="qty_barang_masuk">Qty Barang Masuk</label>
        <input type="number" name="qty_barang_masuk" id="qty_barang_masuk">
        <label for="id_supplier">ID Supplier</label>
        <input type="text" name="id_supplier" id="id_supplier">
        <label for="tanggal_masuk">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" id="tanggal_masuk">
        <input type="submit" value="Tambahkan">
    </form>
    <?php if ($msg): ?>
        <script>
            alert("<?php echo $msg; ?>");
            window.location.href = "read_barang_masuk.php";
        </script>
    <?php endif; ?>
</div>
