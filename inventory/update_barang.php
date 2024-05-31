<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$msg = "";

if (isset($_GET["kode_barang"])) {
    if (!empty($_POST)) {
        $kode_barang = isset($_POST["kode_barang"]) ? $_POST["kode_barang"] : $product["kode_barang"];
        $nama_barang = isset($_POST["nama_barang"]) ? $_POST["nama_barang"] : $product["nama_barang"];
        $jenis_barang = isset($_POST["jenis_barang"]) ? $_POST["jenis_barang"]: $product["jenis_barang"];
        $qty_barang = isset($_POST["qty_barang"]) ? $_POST["qty_barang"] : $product["qty_barang"];
        $harga_barang = isset($_POST["harga_barang"]) ? $_POST["harga_barang"] : $product["harga_barang"];

        $stmt = $pdo->prepare(
            "UPDATE barang SET kode_barang = ?, nama_barang = ?, jenis_barang = ?, qty_barang = ?, harga_barang = ? WHERE kode_barang = ?"
        );
        $stmt->execute([
            $kode_barang,
            $nama_barang,
            $jenis_barang,
            $qty_barang,
            $harga_barang,
            $_GET["kode_barang"],
        ]);
        $msg = "Barang berhasil diedit!";
    }

    $stmt = $pdo->prepare("SELECT * FROM barang WHERE kode_barang = ?");
    $stmt->execute([$_GET["kode_barang"]]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        exit("Barang tidak ditemukan dengan ID tersebut!");
    }
} else {
    exit("ID tidak ditentukan!");
}
?>

<?= template_header("Update") ?>

<div class="content update">
    <h2>Edit Barang: <?= $product["nama_barang"] ?> - <?= $product["jenis_barang"] ?></h2>
    <form action="update_barang.php?kode_barang=<?= $product["kode_barang"] ?>" method="post">
        <label for="kode_barang">Kode Barang</label>
        <input type="text" name="kode_barang" id="kode_barang" value="<?= $product[
            "kode_barang"
        ] ?>">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" value="<?= $product[
            "nama_barang"
        ] ?>">
        <label for="jenis_barang">Jenis Barang</label>
        <input type="text" name="jenis_barang" id="jenis_barang" value="<?= $product[
            "jenis_barang"
        ] ?>">
        <label for="qty_barang">Qty Barang</label>
        <input type="number" name="qty_barang" id="qty_barang" value="<?= $product[
            "qty_barang"
        ] ?>">
        <label for="harga_barang">Harga_Barang</label>
        <input type="number" name="harga_barang" id="harga_barang" value="<?= $product[
            "harga_barang"
        ] ?>">
        <input type="submit" value="Simpan">
    </form>
    <?php if ($msg): ?>
        <script>
            alert("<?php echo $msg; ?>");
            window.location.href = "read_barang.php";
        </script>
    <?php endif; ?>
</div>

