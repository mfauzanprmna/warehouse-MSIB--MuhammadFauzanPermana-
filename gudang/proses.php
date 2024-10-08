<?php
session_start();

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
        $_SESSION['message'] = "Data berhasil ditambah";
        $_SESSION['type'] = "success";
 
    } else {
        $_SESSION['message'] = "Data gagal ditambah";
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php");
    exit();
}

if (isset($_GET['update']) && $_GET['update'] == 'yes' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    if ($gudang->update($_GET['id'])) {
        $_SESSION['message'] = "Data berhasil diubah";
        $_SESSION['type'] = "success";

    } else {
        $_SESSION['message'] = "Data gagal diubah";
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php");
    exit();
}

if (isset($_GET['aktif']) && isset($_GET['id'])) {
    if ($_GET['aktif'] == 'true') {
        $gudang->status = 'aktif';
        $_SESSION['message'] = "Gudang berhasil diaktifkan";
        $_SESSION['type'] = "success";
    } else {
        $gudang->status = 'tidak_aktif';
        $_SESSION['message'] = "Gudang berhasil dinonaktifkan";
        $_SESSION['type'] = "success";
    }

    if (!$gudang->updateStatus($_GET['id'])) {
        $_SESSION['message'] = "Data gagal diubah";
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php");
    exit();
}

if (isset($_GET['delete']) && $_GET['delete'] == 'yes') {

    if ($gudang->delete($_GET['id'])) {
        $_SESSION['message'] = "Data berhasil dihapus";
        $_SESSION['type'] = "success";
        
    } else {
        $_SESSION['message'] = "Data gagal dihapus";
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php");
    exit();
}
