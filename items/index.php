<?php

require_once "item.php";
require_once "../gudang/gudang.php";
require_once "../database.php";

$i = 1;

$database = new Database();
$db = $database->getConnection();

$item = new Item($db);
$gudang = new Gudang($db);

$sum = 0;

if (isset($_GET['gudang'])) {
    $id = $_GET['gudang'];

    $stmt = $item->read($id);
    $num = $stmt->rowCount();

    $data = $gudang->readOne($id);
    $rowGudang = $data->fetch(PDO::FETCH_ASSOC);
}

$stockUpdate = $rowGudang['capacity'] - $sum;

if ($stockUpdate = 0) {
    $class = "disabled-button";
}

ob_start()

?>

<h1>List Barang di Gudang <?php echo $rowGudang['name']; ?></h1>
<h3 class="mb-3">Capacity <?php echo $rowGudang['capacity'] - $sum; ?></h3>

<a href="/items/create.php?gudang=<?php echo $id; ?>" class="btn btn-primary mb-2 <?php $class; ?>">Add Data</a>
<a href="/gudang" class="btn btn-primary ms-2 mb-2">Kembali</a>

<table class="table table-striped table-bordered dataTable" data-page-length='25'>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Stock</th>
            <th>Jenis Barang</th>
            <th>Tanggal Barang Ditambahkan</th>
            <th>Action</th>
        </tr>
    </thead>

    <?php if ($num > 0) : ?>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
            $sum = +$row['stock'];
        ?>
            <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['create_timestamp']; ?></td>
                <td>
                    <a href="/items/update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Update</a>
                    <a href="/items/prosesItem.php?delete=yes&id=<?php echo $row['id']; ?>&gudang=<?php echo $rowGudang['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else : ?>
        <tr>
            <td colspan="8">No records found</td>
            <td class="d-none">No records found</td>
            <td class="d-none">No records found</td>
            <td class="d-none">No records found</td>
            <td class="d-none">No records found</td>
            <td class="d-none">No records found</td>
        </tr>
    <?php endif; ?>
</table>

<?php
$content = ob_get_clean();
include "../layout.php";
?>