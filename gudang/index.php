<?php

session_start();

require_once "gudang.php";
require_once "../database.php";

$i = 1;

$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);

$stmt = $gudang->read();
$num = $stmt->rowCount();

ob_start()

?>

<h1>Gudang</h1>

<a href="/gudang/create.php" class="btn btn-primary mb-2">Add Data</a>

<table class=" table table-striped table-bordered dataTable" data-page-length='25'>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Location</th>
            <th>Capacity</th>
            <th>Status</th>
            <th>Opening Hour</th>
            <th>Closing Hour</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php if ($num > 0) : ?>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
                if ($row['status'] == 'aktif') {
                    $class = 'bg-success';
                    $status = 'Aktif';
                } else {
                    $class = 'bg-danger';
                    $status = 'Tidak Aktif';
                }
            ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['capacity']; ?></td>
                    <td class="text-center">
                        <p class="<?php echo $class; ?> text-white rounded-pill p-1"><?php echo $status; ?></p>
                    </td>
                    <td><?php echo $row['opening_hour']; ?></td>
                    <td><?php echo $row['closing_hour']; ?></td>
                    <td>
                        <div class=" d-flex justify-content-between">
                            <a href="/gudang/update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Update</a>
                            <a href="/gudang/proses.php?delete=yes&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            <?php
                            if ($row['status'] == 'aktif') :
                            ?>
                                <a href="/gudang/proses.php?id=<?php echo $row['id']; ?>&aktif=false" class="btn btn-secondary">Nonaktifkan</a>
                            <?php
                            elseif ($row['status'] == 'tidak_aktif') :
                            ?>
                                <a href="/gudang/proses.php?id=<?php echo $row['id']; ?>&aktif=true" class="btn btn-primary">Aktifkan</a>
                            <?php
                            endif;
                            ?>
                        </div>
                        <div class="mt-2">
                            <a href="/items?gudang=<?php echo $row['id']; ?>" class="btn btn-info w-100">List Barang</a>
                        </div>
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
                <td class="d-none">No records found</td>
                <td class="d-none">No records found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php if (isset($_SESSION['message'])) : ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-header bg-<?= $_SESSION['type']; ?> text-light">
                <strong class="me-auto">Notifikasi</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= $_SESSION['message']; ?>
            </div>
        </div>
    </div>

    <?php
    unset($_SESSION['message']);
    unset($_SESSION['type']);
    ?>

<?php endif; ?>

<?php
$content = ob_get_clean();
include "../layout.php";
?>