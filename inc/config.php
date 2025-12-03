<?php
// Mulai session (untuk flash message)
session_start();

// Konfigurasi database
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'produk_tugas';

// Base URL
const BASE_URL = 'http://localhost:8080/';

// Autoload class dari folder /class di root project
spl_autoload_register(function ($class_name) {
    $file = __DIR__ . '/../class/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Menu navigasi
const NAV_PAGES = [
    ['title' => 'Beranda',     'url' => 'index.php'],
    ['title' => 'Daftar Item', 'url' => 'list.php'],
    ['title' => 'Tambah Item', 'url' => 'create.php'],
];
