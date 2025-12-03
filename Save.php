<?php
require 'inc/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Utility::redirect('create.php');
}

// Mengambil data
$nama     = trim($_POST['nama'] ?? '');
$harga    = $_POST['harga'] ?? 0;
$kategori = $_POST['kategori'] ?? '';
$stok     = $_POST['stok'] ?? 0;

// Validasi dasar
$errors = [];
if (empty($nama)) $errors[] = "Nama wajib diisi.";
if (!is_numeric($harga) || $harga < 0) $errors[] = "Harga harus angka >= 0.";
if (!in_array($kategori, ['elektronik', 'pakaian'])) $errors[] = "Kategori tidak valid.";
if (!is_numeric($stok) || $stok < 0) $errors[] = "Stok harus angka >= 0.";

// Simpan prefill
$prefill = compact('nama', 'harga', 'kategori', 'stok');

// Jika ada error → kembali ke form
if (!empty($errors)) {
    $msg = implode('<br>', $errors);
    Utility::redirect('create.php', $msg, $prefill);
}

// Simpan ke DB
$item = new Product();
$item->nama     = $nama;
$item->harga    = $harga;
$item->kategori = $kategori;
$item->stok     = $stok;

if ($item->save()) {
    Utility::clearPrefill();
    Utility::redirect('list.php', 'Item berhasil ditambahkan.');
} else {
    Utility::redirect('create.php', 'Gagal menyimpan data.', $prefill);
}
