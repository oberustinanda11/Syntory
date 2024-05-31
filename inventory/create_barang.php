<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";


if (!empty($_POST)) {
    $kode_barang = isset($_POST["kode_barang"]) && $_POST["kode_barang"] !== "auto" ? $_POST["kode_barang"] : null;
    $nama_barang = isset($_POST["nama_barang"]) ? $_POST["nama_barang"] : "";
    $jenis_barang = isset($_POST["jenis_barang"]) ? $_POST["jenis_barang"] : "";
    $qty_barang = isset($_POST["qty_barang"]) ? $_POST["qty_barang"] : 0;
    $harga_barang = isset($_POST["harga_barang"]) ? $_POST["harga_barang"] : 0;

    $stmt = $pdo->prepare(
        "INSERT INTO barang (kode_barang, nama_barang, jenis_barang, qty_barang, harga_barang) VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $kode_barang,
        $nama_barang,
        $jenis_barang,
        $qty_barang,
        $harga_barang,
    ]);

    $msg = "Barang berhasil ditambahkan!";
}
?>

<?= template_header("Create") ?>

<div class="content update">
    <h2>Tambah Barang</h2>
        <form action="create_barang.php" method="post">
        <label for="kode_barang">Kode Barang</label>
        <input type="text" name="kode_barang" id="kode_barang">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang">
        <label for="jenis_barang">Jenis Barang</label>
        <input type="text" name="jenis_barang" id="jenis_barang">
        <label for="qty_barang">Qty Barang</label>
        <input type="number" name="qty_barang" id="qty_barang">
        <label for="harga_barang">Harga Barang</label>
        <input type="number" name="harga_barang" id="harga_barang">
        <input type="submit" value="Tambahkan">
    </form>
    <?php if ($msg): ?>
        <script>
            alert("<?php echo $msg; ?>");
            window.location.href = "read_barang.php";
        </script>
    <?php endif; ?>
</div>
