<?php
// Mulai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Konfigurasi Database
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'produk_tugas';

// Base URL aplikasi
const BASE_URL = 'http://localhost:8000/';

// Navigasi khusus Produk
const NAV_PAGES = [
    ['title' => 'Home',        'url' => 'index.php'],
    ['title' => 'Tambah Produk','url' => 'create.php'],
    ['title' => 'Galeri Produk','url' => 'gallery.php'],
    ['title' => 'Kontak',      'url' => 'contact.php'],
    ['title' => 'Logout',      'url' => 'logout.php']
];

// Folder upload
const UPLOAD_DIR = __DIR__ . '/uploads/';
?>