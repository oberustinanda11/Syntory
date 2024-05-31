<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$page = isset($_GET["page"]) && is_numeric($_GET["page"]) ? (int) $_GET["page"] : 1;
$records_per_page = 8;

$stmt = $pdo->prepare(
    "SELECT *, ROW_NUMBER() OVER (ORDER BY kode_barang) AS row_num FROM barang LIMIT :current_page, :record_per_page"
);
$stmt->bindValue(
    ":current_page",
    ($page - 1) * $records_per_page,
    PDO::PARAM_INT
);
$stmt->bindValue(":record_per_page", $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_product = $pdo->query("SELECT COUNT(*) FROM barang")->fetchColumn();
?>

<?= template_header("Read") ?>

<div class="content read">
	<h2>Daftar Stok Barang</h2>
	<a href="create_barang.php" class="create-medicine">Tambah Barang</a>
	<table>
        <thead>
            <tr>
                <td>No</td>
                <td>Kode Barang</td>
                <td>Nama Barang</td>
                <td>Jenis_Barang</td>
                <td>Qty Barang</td>
                <td>Harga Barang</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product["row_num"] ?></td>
                <td><?= $product["kode_barang"] ?></td>
                <td><?= $product["nama_barang"] ?></td>
                <td><?= $product["jenis_barang"] ?></td>
                <td><?= $product["qty_barang"] ?></td>
                <td><?= $product["harga_barang"] ?></td>
                <td class="actions">
                    <a href="update_barang.php?kode_barang=<?= $product[
                        "kode_barang"
                    ] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_barang.php?kode_barang=<?= $product[
                        "kode_barang"
                    ] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read_barang.php?page=<?= $page -
      1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page * $records_per_page < $num_product): ?>
		<a href="read_barang.php?page=<?= $page +
      1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

