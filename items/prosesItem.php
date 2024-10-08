<?php
session_start();

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
        $_SESSION['message'] = "Data berhasil ditambah";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['message'] = "Data gagal ditambah";
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php?gudang={$_POST['id_gudang']}");
    exit();
}

if (isset($_GET['update']) && $_GET['update'] == 'yes' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $item->name = $_POST['name'];
    $item->stock = $_POST['stock'];
    $item->type = $_POST['type'];

    if ($item->update($_GET['id'])) {
        $_SESSION['message'] = "Data berhasil diubah";
        $_SESSION['type'] = "success";

    } else {
        $_SESSION['message'] = "Data gagal diubah";
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php?gudang={$_POST['id_gudang']}");
    exit();
}

if (isset($_GET['delete']) && $_GET['delete'] == 'yes') {
    if ($item->delete($_GET['id'])) {
        $_SESSION['message'] = "Data berhasil dihapus";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['message'] = "Data gagal dihapus";
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php?gudang={$_GET['gudang']}");
    exit();
}
