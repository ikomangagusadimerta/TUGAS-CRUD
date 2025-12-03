<?php
require 'inc/config.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) {
    Utility::redirect('list.php', 'ID tidak valid.');
}

$product = new Product();
if (!$product->setById($id)) {
    Utility::redirect('list.php', 'Item tidak ditemukan.');
}

// Hapus item dari database
if ($product->remove()) {
    Utility::redirect('list.php', 'Item berhasil dihapus.');
} else {
    Utility::redirect('list.php', 'Gagal menghapus item.');
}
