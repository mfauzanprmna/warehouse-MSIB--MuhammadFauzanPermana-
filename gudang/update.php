<?php
require_once "gudang.php";
require_once "../database.php";

$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $gudang->readOne($id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

ob_start();
?>

<a href="index.php" class="btn btn-primary mb-3">Kembali</a>

<form action="proses.php?update=yes&id=<?php echo $id; ?>" method="post">
    <div class="mb-2">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name']; ?>" required><br>
    </div>

    <div class="mb-2">
        <label for="location">Location:</label>
        <input type="text" class="form-control" name="location" id="location" value="<?php echo $row['location']; ?>" required><br>
    </div>

    <div class="mb-2">
        <label for="capacity">Capacity:</label>
        <input type="number" class="form-control" name="capacity" id="capacity" value="<?php echo $row['capacity']; ?>" required><br>
    </div>

    <div class="mb-2">
        <label for="status">Status:</label>
        <select name="status" id="" class="form-control">
            <option value="aktif" <?php if ($row['status'] == 'aktif') echo 'selected'; ?>>Aktif</option>
            <option value="tidak_aktif" <?php if ($row['status'] == 'tidak_aktif') echo 'selected'; ?>>Tidak Aktif</option>
        </select>
    </div>

    <div class="mb-2">
        <label for="opening_hour">Opening Hour:</label>
        <input type="time" class="form-control" name="opening_hour" id="opening_hour" value="<?php echo $row['opening_hour']; ?>" required><br>
    </div>

    <div class="mb-2">
        <label for="closing_hour">Closing Hour:</label>
        <input type="time" class="form-control" name="closing_hour" id="closing_hour" value="<?php echo $row['closing_hour']; ?>" required><br>
    </div>

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
$content = ob_get_clean();
include '../layout.php';
?>