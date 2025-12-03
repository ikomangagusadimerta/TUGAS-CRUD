<?php
require 'inc/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Utility::redirect('list.php');
}

$id = (int)($_POST['id'] ?? 0);
if (!$id) {
    Utility::redirect('list.php', 'ID item tidak valid.');
}

$item = new Product();
if (!$item->setById($id)) {
    Utility::redirect('list.php', 'Item tidak ditemukan.');
}

// Mengambil data baru
$nama     = trim($_POST['nama'] ?? '');
$harga    = $_POST['harga'] ?? 0;
$kategori = $_POST['kategori'] ?? '';
$stok     = $_POST['stok'] ?? 0;

// Validasi
$errors = [];
if (empty($nama)) $errors[] = "Nama wajib diisi.";
if (!is_numeric($harga) || $harga < 0) $errors[] = "Harga harus angka ≥ 0.";
if (!in_array($kategori, ['elektronik', 'pakaian'])) $errors[] = "Kategori tidak valid.";
if (!is_numeric($stok) || $stok < 0) $errors[] = "Stok harus angka ≥ 0.";

if (!empty($errors)) {
    $msg = implode('<br>', $errors);
    Utility::redirect("edit.php?id=$id", $msg);
}

// Update data
$item->nama     = $nama;
$item->harga    = $harga;
$item->kategori = $kategori;
$item->stok     = $stok;

if ($item->save()) {
    Utility::redirect('list.php', 'Data item berhasil diperbarui.');
} else {
    Utility::redirect("edit.php?id=$id", 'Gagal memperbarui data.');
}
