<?php
require_once "config.php";
require_once "class/Database.php";
require_once "class/Product.php";
require_once "class/Utility.php";

$db = new Database();
$product = new Product($db);

// Ambil semua produk
$products = $product->getAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h1>Aplikasi CRUD Produk</h1>
    <?php Utility::renderNavigation(); ?>
    <?= Utility::getFlash(); ?>

    <h2>Daftar Produk</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['category']); ?></td>
                    <td>Rp <?= number_format($row['price'], 2, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($row['stock']); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                    <td>
                        <?php if (!empty($row['image_path'])): ?>
                            <img src="<?= BASE_URL . $row['image_path']; ?>" alt="Produk" style="max-width:60px;">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td>
                        <a class="btn" href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                        <a class="btn" href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8">Belum ada produk.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>