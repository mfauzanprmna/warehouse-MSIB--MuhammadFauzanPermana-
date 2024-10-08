<?php
require_once "item.php";
require_once "../database.php";

$database = new Database();
$db = $database->getConnection();

$item = new Item($db);

if (isset($_GET['add']) && $_GET['add'] == 'yes' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $item->name = $_POST['name'];
    $item->stock = $_POST['stock'];
    $item->type = $_POST['type'];
    $item->id_gudang = $_POST['id_gudang'];

    if ($item->create()) {
        header("Location: index.php?gudang={$_POST['id_gudang']}");
        exit();
    } else {
        echo "Gagal menambah data";
    }
}

if (isset($_GET['update']) && $_GET['update'] == 'yes' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $item->name = $_POST['name'];
    $item->stock = $_POST['stock'];
    $item->type = $_POST['type'];

    if ($item->update($_GET['id'])) {
        header("Location: index.php?gudang={$_POST['id_gudang']}");
        exit();
    } else {
        echo "Gagal mengubah data";
    }
}

if (isset($_GET['delete']) && $_GET['delete'] == 'yes') {
    if ($item->delete($_GET['id'])) {
        header("Location: index.php?gudang={$_GET['gudang']}");
        exit();
    } else {
        echo "Gagal menghapus data";
    }
}
