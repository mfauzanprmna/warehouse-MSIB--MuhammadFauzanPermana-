<?php
ob_start();
?>

<h1>Tambah Data Gudang</h1>

<a href="index.php" class="btn btn-primary mb-3">Kembali</a>
<form action="proses.php?add=yes" method="post">
    <div class="mb-2">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" id="name" required><br>
    </div>

    <div class="mb-2">
        <label for="location">Location:</label>
        <input type="text" class="form-control" name="location" id="location" required><br>
    </div>

    <div class="mb-2">
        <label for="capacity">Capacity:</label>
        <input type="number" class="form-control" name="capacity" id="capacity" required><br>
    </div>

    <div class="mb-2">
        <label for="status">Status:</label>
        <select name="status" id="" class="form-control">
            <option value="aktif">Aktif</option>
            <option value="tidak_aktif">Tidak Aktif</option>
        </select>
    </div>

    <div class="mb-2">
        <label for="opening_hour">Opening Hour:</label>
        <input type="time" class="form-control" name="opening_hour" id="opening_hour" required><br>
    </div>

    <div class="mb-2">
        <label for="closing_hour">Closing Hour:</label>
        <input type="time" class="form-control" name="closing_hour" id="closing_hour" required><br>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
$content = ob_get_clean();
include '../layout.php';
?>