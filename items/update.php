<?php
require_once "item.php";
require_once "../database.php";

$database = new Database();
$db = $database->getConnection();

$item = new Item($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $item->readOne($id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

ob_start();
?>

<a href="index.php?gudang=<?php echo $id_gudang; ?>" class="btn btn-primary mb-3">Kembali</a>

<form action="proses.php?update=yes&id=<?php echo $id; ?>" method="post">
    <div class="mb-2">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name']; ?>" required><br>
    </div>

    <div class="mb-2">
        <label for="stock">Stock:</label>
        <input type="number" class="form-control" name="stock" id="stock" value="<?php echo $row['stock']; ?>" required><br>
    </div>

    <div class="mb-2">
        <label for="type">Jenis Barang:</label>
        <input type="number" class="form-control" name="type" id="type" value="<?php echo $row['type']; ?>" required><br>
    </div>

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
$content = ob_get_clean();
include '../layout.php';
?>