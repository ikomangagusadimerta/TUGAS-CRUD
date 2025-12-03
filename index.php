<?php require 'inc/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Item - Beranda</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Aplikasi Manajemen Item</h1>
        <p>CRUD sederhana tanpa autentikasi</p>
    </header>

    <?php Utility::showNav(); ?>

    <main>
        <h2>Selamat Datang!</h2>
        <p>Gunakan menu di atas untuk:</p>
        <ul>
            <li>Melihat daftar item</li>
            <li>Menambahkan item baru</li>
            <li>Mengedit atau menghapus data</li>
        </ul>
        <p><em>Data disimpan di tabel <code>items</code> pada database, tanpa upload file gambar.</em></p>
    </main>
</body>
</html>
