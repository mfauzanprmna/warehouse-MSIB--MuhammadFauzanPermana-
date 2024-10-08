<?php
require_once "gudang.php";
require_once "../database.php";

$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);

if (isset($_GET['add']) && $_GET['add'] == 'yes' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    if ($gudang->create()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambah data";
    }
}

if (isset($_GET['update']) && $_GET['update'] == 'yes' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    if ($gudang->update($_GET['id'])) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal mengubah data";
    }
}

if (isset($_GET['aktif']) && isset($_GET['id'])) {
    if ($_GET['aktif'] == 'true') {
        $gudang->status = 'aktif';
    } else {
        $gudang->status = 'tidak_aktif';
    }

    if ($gudang->updateStatus($_GET['id'])) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal mengubah data";
    }
}

if (isset($_GET['delete']) && $_GET['delete'] == 'yes') {

    if ($gudang->delete($_GET['id'])) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data";
    }
}
