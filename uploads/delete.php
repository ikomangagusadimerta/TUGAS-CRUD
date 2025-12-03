<?php
require_once "config.php";
require_once "class/Database.php";
require_once "class/Product.php";
require_once "class/Utility.php";

// Inisialisasi
$db = new Database();
$product = new Product($db);

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Ambil produk berdasarkan ID
    if ($product->getById($id)) {
        // Hapus produk
        if ($product->delete()) {
            Utility::setFlash("Produk berhasil dihapus!", "success");
        } else {
            Utility::setFlash("Gagal menghapus produk!", "error");
        }
    } else {
        Utility::setFlash("Produk tidak ditemukan!", "error");
    }
} else {
    Utility::setFlash("ID produk tidak valid!", "error");
}

// Redirect kembali ke index
Utility::redirect("index.php");
?>