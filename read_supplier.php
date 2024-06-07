<?php
include "fungsi.php";
$pdo = pdo_connect_mysql();
$page = isset($_GET["page"]) && is_numeric($_GET["page"]) ? (int) $_GET["page"] : 1;
$records_per_page = 8;

$stmt = $pdo->prepare(
    "SELECT *, ROW_NUMBER() OVER (ORDER BY id_supplier) AS row_num FROM supplier LIMIT :current_page, :record_per_page"
);
$stmt->bindValue(
    ":current_page",
    ($page - 1) * $records_per_page,
    PDO::PARAM_INT
);
$stmt->bindValue(":record_per_page", $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_product = $pdo->query("SELECT COUNT(*) FROM supplier")->fetchColumn();
?>

<?= template_header("Read") ?>

<div class="content read">
	<h2>Daftar Supplier</h2>
	<a href="create_supplier.php" class="create-medicine">Tambah Supplier</a>
	<table>
        <thead>
            <tr>
                <td>No</td>
                <td>ID Supplier</td>
                <td>Nama Supplier</td>
                <td>Barang yang Disupply</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product["row_num"] ?></td>
                <td><?= $product["id_supplier"] ?></td>
                <td><?= $product["nama_supplier"] ?></td>
                <td><?= $product["barang_supply"] ?></td>
                <td class="actions">
                    <a href="update_supplier.php?id_supplier=<?= $product[
                        "id_supplier"
                    ] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_supplier.php?id_supplier=<?= $product[
                        "id_supplier"
                    ] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read_supplier.php?page=<?= $page -
      1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page * $records_per_page < $num_product): ?>
		<a href="read_supplier.php?page=<?= $page +
      1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

