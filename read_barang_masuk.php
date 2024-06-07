<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$page = isset($_GET["page"]) && is_numeric($_GET["page"]) ? (int) $_GET["page"] : 1;
$records_per_page = 8;

$stmt = $pdo->prepare(
    "SELECT *, ROW_NUMBER() OVER (ORDER BY id_transaksi_masuk) AS row_num FROM barang_masuk LIMIT :current_page, :record_per_page"
);
$stmt->bindValue(
    ":current_page",
    ($page - 1) * $records_per_page,
    PDO::PARAM_INT
);
$stmt->bindValue(":record_per_page", $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_product = $pdo->query("SELECT COUNT(*) FROM barang_masuk")->fetchColumn();
?>

<?= template_header("Read") ?>

<div class="content read">
	<h2>Daftar Transaksi Barang Masuk</h2>
	<a href="create_barang_masuk.php" class="create-medicine">Tambah Transaksi Masuk</a>
	<table>
        <thead>
            <tr>
                <td>No</td>
                <td>ID Transaksi Masuk</td>
                <td>Nama Barang</td>
                <td>Kode Barang</td>
                <td>Qty Barang Masuk</td>
                <td>ID Supplier</td>
                <td>Tanggal Masuk</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product["row_num"] ?></td>
                <td><?= $product["id_transaksi_masuk"] ?></td>
                <td><?= $product["nama_barang"] ?></td>
                <td><?= $product["kode_barang"] ?></td>
                <td><?= $product["qty_barang_masuk"] ?></td>
                <td><?= $product["id_supplier"] ?></td>
                <td><?= date(
                    "d-m-Y",
                    strtotime($product["tanggal_masuk"])
                ) ?></td>
                <td class="actions">
                    <a href="update_barang_masuk.php?id_transaksi_masuk=<?= $product[
                        "id_transaksi_masuk"
                    ] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_barang_masuk.php?id_transaksi_masuk=<?= $product[
                        "id_transaksi_masuk"
                    ] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read_barang_masuk.php?page=<?= $page -
      1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page * $records_per_page < $num_product): ?>
		<a href="read_barang_masuk.php?page=<?= $page +
      1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

