<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";

if (isset($_GET["id_transaksi_masuk"])) {
    if (!empty($_POST)) {
        $id_transaksi_masuk = isset($_POST["id_transaksi_masuk"]) ? $_POST["id_transaksi_masuk"] : $product["id_transaksi_masuk"];
        $nama_barang = isset($_POST["nama_barang"]) ? $_POST["nama_barang"] : $product["nama_barang"];
        $kode_barang = isset($_POST["kode_barang"]) ? $_POST["kode_barang"]: $product["kode_barang"];
        $qty_barang_masuk = isset($_POST["qty_barang_masuk"]) ? $_POST["qty_barang_masuk"] : $product["qty_barang_masuk"];
        $id_supplier = isset($_POST["id_supplier"]) ? $_POST["id_supplier"] : $product["id_supplier"];
        $tanggal_masuk = isset($_POST["tanggal_masuk"]) ? $_POST["tanggal_masuk"] : $medicine["tanggal_masuk"];

        $stmt = $pdo->prepare(
            "UPDATE barang_masuk SET id_transaksi_masuk = ?, nama_barang = ?, kode_barang = ?, qty_barang_masuk = ?, id_supplier = ?, tanggal_masuk = ? WHERE id_transaksi_masuk = ?"
        );
        $stmt->execute([
            $id_transaksi_masuk,
            $nama_barang,
            $kode_barang,
            $qty_barang_masuk,
            $id_supplier,
            $tanggal_masuk,
            $_GET["id_transaksi_masuk"],
        ]);
        $msg = "Barang masuk berhasil diedit!";
    }

    $stmt = $pdo->prepare("SELECT * FROM barang_masuk WHERE id_transaksi_masuk = ?");
    $stmt->execute([$_GET["id_transaksi_masuk"]]);
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
    <h2>Edit Barang Masuk: <?= $product["nama_barang"] ?> - <?= $product["kode_barang"] ?></h2>
    <form action="update_barang_masuk.php?id_transaksi_masuk=<?= $product["id_transaksi_masuk"] ?>" method="post">
        <label for="id_transaksi_masuk">ID Transaksi Masuk</label>
        <input type="text" name="id_transaksi_masuk" id="id_transaksi_masuk" value="<?= $product[
            "id_transaksi_masuk"
        ] ?>">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" value="<?= $product[
            "nama_barang"
        ] ?>">
        <label for="kode_barang">Kode Barang</label>
        <input type="text" name="kode_barang" id="kode_barang" value="<?= $product[
            "kode_barang"
        ] ?>">
        <label for="qty_barang_masuk">Qty Barang Masuk</label>
        <input type="number" name="qty_barang_masuk" id="qty_barang_masuk" value="<?= $product[
            "qty_barang_masuk"
        ] ?>">
        <label for="id_supplier">ID Supplier</label>
        <input type="text" name="id_supplier" id="id_supplier" value="<?= $product[
            "id_supplier"
        ] ?>">
         <label for="tanggal_masuk">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="<?= $product[
            "tanggal_masuk"
        ] ?>">
        <input type="submit" value="Simpan">
    </form>
    <?php if ($msg): ?>
        <script>
            alert("<?php echo $msg; ?>");
            window.location.href = "read_barang_masuk.php";
        </script>
    <?php endif; ?>
</div>

