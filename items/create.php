<?php

if (isset($_GET['gudang'])) {
    $id = $_GET['gudang'];
}

ob_start();
?>

<h1>Tambah Data Gudang</h1>

<a href="index.php?gudang=<?php echo $id; ?>" class="btn btn-primary mb-3">Kembali</a>
<form action="prosesItem.php?add=yes" method="post">
    <div class="mb-2">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" id="name" required><br>
    </div>

    <div class="mb-2">
        <label for="stock">Stock:</label>
        <input type="number" class="form-control" name="stock" id="stock" required><br>
    </div>

    <div class="mb-2">
        <label for="type">Jenis Barang:</label>
        <input type="text" class="form-control" name="type" id="type" required><br>
    </div>

    <input type="hidden" name="id_gudang" value="<?php echo $id; ?>">

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
$content = ob_get_clean();
include '../layout.php';
?>